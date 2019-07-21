<?php

namespace App\Services\Validation\Validators;

use App\Services\Validation\DuplicateSelectionError;
use App\Services\Validation\StructureMismatchError;
use App\Services\Validation\MaximumOddError;
use App\Services\Validation\MaximumSelectionsAmountError;
use App\Services\Validation\MinimumOddError;
use App\Services\Validation\MinimumSelectionsAmountError;
use Illuminate\Http\Request;
use App\Services\Validation\ValidationError;

/**
 * Class SelectionsValidator
 * @package App\Services\Validation\Validators
 */
class SelectionsValidator extends AbstractValidator
{
    const STEP = 0.001;

    /**
     * @param Request $request
     * @return ValidationError|null
     */
    public function validate(Request $request): ?ValidationError
    {
        $selections = $request->get('selections');

        if (count($selections) < $this->config->get('app.selection.min_amount')) {
            return new MinimumSelectionsAmountError();
        }

        if (count($selections) > $this->config->get('app.selection.max_amount')) {
            return new MaximumSelectionsAmountError();
        }

        return $this->validateOdds($selections);
    }

    /**
     * @param array $selections
     * @return ValidationError|null
     */
    protected function validateOdds(array $selections): ?ValidationError
    {
        $selectionsIds = [];

        foreach ($selections as $key => $selection) {
            if ($selection['odds'] < $this->config->get('app.odd.min')) {
                return new MinimumOddError($key);
            }

            if ($selection['odds'] > $this->config->get('app.odd.max')) {
                return new MaximumOddError($key);
            }

            if (!$this->validFormat($selection['odds'], $this->config->get('app.odd.step'))) {
                return new StructureMismatchError();
            }

            if (in_array($selection['id'], $selectionsIds)) {
                return new DuplicateSelectionError();
            }
            $selectionsIds[] = $selection['id'];
        }

        return null;
    }
}
