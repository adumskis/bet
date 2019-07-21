<?php

namespace App\Exceptions;

use Exception;
use Throwable;

/**
 * Class ValidationException
 * @package App\Exceptions
 */
class ValidationException extends Exception
{
    /**
     * @var array
     */
    protected $validationErrors;

    /**
     * ValidationException constructor.
     * @param array $validationErrors
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        array $validationErrors = [],
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->validationErrors = $validationErrors;
    }

    /**
     * @return array
     */
    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
