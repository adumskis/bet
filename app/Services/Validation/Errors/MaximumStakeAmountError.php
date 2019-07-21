<?php

namespace App\Services\Validation;

/**
 * Class MaximumStakeAmountError
 * @package App\Services\Validation
 */
class MaximumStakeAmountError extends ValidationError
{
    /**
     * MaximumStakeAmountError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            3,
            'Maximum stake amount is ' . config('app.stake.max_amount')
        );
    }
}
