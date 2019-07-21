<?php

namespace App\Exceptions;

use App\Services\Validation\ResponseFormatter;
use App\Services\Validation\UnknownError;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    use LoggerAwareTrait;

    /**
     * @var ResponseFormatter
     */
    protected $formatter;

    /**
     * Handler constructor.
     * @param ResponseFormatter $formatter
     * @param LoggerInterface $logger
     */
    public function __construct(ResponseFormatter $formatter, LoggerInterface $logger)
    {
        $this->formatter = $formatter;
        $this->logger = $logger;
    }

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class
    ];

    /**
     * @param Exception $exception
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Exception $exception
     * @return JsonResponse
     */
    public function render($request, Exception $exception): JsonResponse
    {
        if ($exception instanceof ValidationException) {
            $errors = $exception->getValidationErrors();
            $status = 400;
        } else {
            dd($exception);
            $errors = [new UnknownError()];
            $status = 500;
            $this->logger->error($exception->getMessage(), ['exception' => $exception]);
        }

        return new JsonResponse($this->formatter->format($request->all(), $errors), $status);
    }
}
