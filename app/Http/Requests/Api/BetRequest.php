<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Services\Validation\Validators\BalanceValidator;
use App\Services\Validation\Validators\MaximumWinValidator;
use App\Services\Validation\Validators\SelectionsValidator;
use App\Services\Validation\Validators\StakeAmountValidator;
use App\Services\Validation\Validators\StructureValidator;

/**
 * Class BetRequest
 * @package App\Http\Requests\Api
 */
class BetRequest extends Request
{
    /**
     * @return array
     */
    public function validators(): array
    {
        return [
            StructureValidator::class,
            StakeAmountValidator::class,
            SelectionsValidator::class,
            MaximumWinValidator::class,
            BalanceValidator::class,
        ];
    }
}
