<?php

namespace App\Services\Validation;

/**
 * Class MinimumStakeAmountError
 * @package App\Services\Validation
 */
class MinimumStakeAmountError extends ValidationError
{
    /**
     * MinimumStakeAmountError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            2,
            'Minimum stake amount is ' . config('app.stake.min_amount')
        );
    }
}
