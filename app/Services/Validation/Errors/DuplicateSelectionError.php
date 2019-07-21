<?php

namespace App\Services\Validation;

/**
 * Class DuplicateSelectionError
 * @package App\Services\Validation
 */
class DuplicateSelectionError extends ValidationError
{
    /**
     * DuplicateSelectionError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            8,
            'Duplicate selection found'
        );
    }
}
