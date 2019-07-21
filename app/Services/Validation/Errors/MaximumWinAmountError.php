<?php

namespace App\Services\Validation;

/**
 * Class MaximumWinAmountError
 * @package App\Services\Validation
 */
class MaximumWinAmountError extends ValidationError
{
    /**
     * MaximumWinAmountError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            9,
            'Maximum win amount is ' . config('app.bet.max_win_amount')
        );
    }
}
