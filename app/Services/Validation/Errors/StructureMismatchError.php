<?php

namespace App\Services\Validation;

/**
 * Class StructureMismatchError
 * @package App\Services\Validation
 */
class StructureMismatchError extends ValidationError
{
    /**
     * StructureMismatchError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            1,
            'Betslip structure mismatch'
        );
    }
}
