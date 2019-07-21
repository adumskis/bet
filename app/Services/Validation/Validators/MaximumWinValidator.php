<?php

namespace App\Services\Validation\Validators;

use App\Services\Validation\MaximumWinAmountError;
use App\Services\Validation\ValidationError;
use Illuminate\Http\Request;

/**
 * Class MaximumWinValidator
 * @package App\Services\Validation\Validators
 */
class MaximumWinValidator extends AbstractValidator
{
    /**
     * @param Request $request
     * @return ValidationError|null
     */
    public function validate(Request $request): ?ValidationError
    {
        $selections = $request->get('selections');
        $winAmount = $request->get('stake_amount');

        foreach ($selections as $selection) {
            $winAmount = $winAmount * $selection['odds'];
        }

        if ($winAmount > $this->config->get('app.bet.max_win_amount')) {
            return new MaximumWinAmountError();
        }

        return null;
    }
}
