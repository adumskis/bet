<?php

namespace App\Services\Validation\Validators;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use App\Services\Validation\ValidationError;
use Illuminate\Validation\Factory;

/**
 * Class AbstractValidator
 * @package App\Services\Validation\Validators
 */
abstract class AbstractValidator
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var Factory
     */
    protected $validationFactory;

    /**
     * AbstractValidator constructor.
     * @param Repository $config
     * @param Factory $validationFactory
     */
    public function __construct(Repository $config, Factory $validationFactory)
    {
        $this->config = $config;
        $this->validationFactory = $validationFactory;
    }

    /**
     * @var array|ValidationError[]
     */
    protected $errors = [];

    /**
     * @var bool
     */
    protected $mandatory = true;

    /**
     * @param Request $request
     * @return ValidationError|null
     */
    abstract public function validate(Request $request): ?ValidationError;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param ValidationError $error
     */
    protected function addError(ValidationError $error): void
    {
        $this->errors[] = $error;
    }

    /**
     * @param float $number
     * @param float $step
     * @return bool
     */
    protected function validFormat(float $number, float $step): bool
    {
        return ($number - intval($number / $step) * $step) == 0;
    }
}
