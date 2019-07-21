<?php

namespace App\Services\Validation\Validators;

use App\Services\Validation\MaximumStakeAmountError;
use App\Services\Validation\MinimumStakeAmountError;
use Illuminate\Http\Request;
use App\Services\Validation\StructureMismatchError;
use App\Services\Validation\ValidationError;

/**
 * Class StakeAmountValidator
 * @package App\Services\Validation\Validators
 */
class StakeAmountValidator extends AbstractValidator
{
    const STEP = 0.01;

    /**
     * @param Request $request
     * @return ValidationError|null
     */
    public function validate(Request $request): ?ValidationError
    {
        $stakeAmount = $request->get('stake_amount');

        if (!$this->validFormat($stakeAmount, $this->config->get('app.stake.step'))) {
            return new StructureMismatchError();
        }

        if ($stakeAmount < $this->config->get('app.stake.min_amount')) {
            return new MinimumStakeAmountError();
        }

        if ($stakeAmount > $this->config->get('app.stake.max_amount')) {
            return new MaximumStakeAmountError();
        }

        return null;
    }

    /**
     * @param string|null $stakeAmount
     * @return bool
     */
    protected function exists(?string $stakeAmount): bool
    {
        return (bool)$stakeAmount;
    }
}
