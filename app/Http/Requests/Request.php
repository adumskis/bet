<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationException;
use App\Services\Validation\Validators\AbstractValidator;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request as BaseRequest;
use Laravel\Lumen\Application;

/**
 * Class Request
 * @package App\Http\Requests
 */
class Request implements ValidatesWhenResolved
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var $request
     */
    protected $request;

    /**
     * Request constructor.
     * @param Application $app
     * @param BaseRequest $request
     */
    public function __construct(Application $app, BaseRequest $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function validateResolved(): void
    {
        $errors = [];

        foreach ($this->validators() as $validatorClass) {
            $validator = $this->app->make($validatorClass);
            $error = $validator->validate($this->request);
            if ($error) {
                $errors[] = $error;
            }
        }

        if ($errors) {
            throw new ValidationException($errors);
        }
    }

    /**
     * @return array|AbstractValidator[]
     */
    public function validators(): array
    {
        return [];
    }
}
