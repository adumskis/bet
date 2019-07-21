<?php

namespace App\Services\Validation;

/**
 * Class UnknownError
 * @package App\Services\Validation
 */
class UnknownError extends ValidationError
{
    /**
     * UnknownError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            0,
            'Unknown error'
        );
    }
}
