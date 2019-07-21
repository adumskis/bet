<?php

namespace App\Services\Validation;

/**
 * Class MinimumOddError
 * @package App\Services\Validation
 */
class MinimumOddError extends ValidationError
{
    /**
     * @var int
     */
    protected $selectionKey;

    /**
     * MinimumOddError constructor.
     * @param int $selectionKey
     */
    public function __construct(int $selectionKey)
    {
        parent::__construct(
            6,
            'Minimum odds are ' . config('app.odd.min')
        );

        $this->selectionKey = $selectionKey;
    }

    /**
     * @return string
     */
    public function getDisplayKey(): string
    {
        return "selections.{$this->selectionKey}.errors";
    }
}
