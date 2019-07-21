<?php

namespace App\Services\Validation;

/**
 * Class MaximumOddError
 * @package App\Services\Validation
 */
class MaximumOddError extends ValidationError
{
    /**
     * @var int
     */
    protected $selectionKey;

    /**
     * MaximumOddError constructor.
     * @param int $selectionKey
     */
    public function __construct(int $selectionKey)
    {
        parent::__construct(
            7,
            'Maximum odds are ' . config('app.odd.max')
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
