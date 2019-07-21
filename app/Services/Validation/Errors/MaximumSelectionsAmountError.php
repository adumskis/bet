<?php

namespace App\Services\Validation;

/**
 * Class MaximumSelectionsAmountError
 * @package App\Services\Validation
 */
class MaximumSelectionsAmountError extends ValidationError
{
    /**
     * MaximumSelectionsAmountError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            5,
            'Maximum number of selections is ' . config('app.selection.max_amount')
        );
    }
}
