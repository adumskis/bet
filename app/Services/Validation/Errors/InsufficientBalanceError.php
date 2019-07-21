<?php

namespace App\Services\Validation;

/**
 * Class InsufficientBalanceError
 * @package App\Services\Validation
 */
class InsufficientBalanceError extends ValidationError
{
    /**
     * InsufficientBalanceError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            11,
            'Insufficient balance'
        );
    }
}
