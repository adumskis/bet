<?php

namespace App\Services\Validation\Validators;

use App\Services\Validation\StructureMismatchError;
use App\Services\Validation\ValidationError;
use Illuminate\Http\Request;

/**
 * Class StructureValidator
 * @package App\Services\Validation\Validators
 */
class StructureValidator extends AbstractValidator
{
    public function validate(Request $request): ?ValidationError
    {
        $validator = $this->validationFactory->make($request->all(), $this->getRules());

        if ($validator->fails()) {
            return new StructureMismatchError();
        }

        return null;
    }

    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'player_id' => 'required|integer|min:1',
            'stake_amount' => 'required|numeric',
            'selections' => 'array',
            'selections.*.id' => 'sometimes|required|integer|min:1',
            'selections.*.odds' => 'sometimes|required|numeric',
        ];
    }
}
