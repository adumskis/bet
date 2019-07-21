<?php

namespace App\Services\Validation;

/**
 * Class MinimumSelectionsAmountError
 * @package App\Services\Validation
 */
class MinimumSelectionsAmountError extends ValidationError
{
    /**
     * MinimumSelectionsAmountError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            4,
            'Minimum number of selections is ' . config('app.selection.min_amount')
        );
    }
}
