<?php

namespace App\Services\Validation;

/**
 * Class PreviousActionNotFinishedError
 * @package App\Services\Validation
 */
class PreviousActionNotFinishedError extends ValidationError
{
    /**
     * PreviousActionNotFinishedError constructor.
     */
    public function __construct()
    {
        parent::__construct(
            10,
            'Your previous action is not finished yet'
        );
    }
}
