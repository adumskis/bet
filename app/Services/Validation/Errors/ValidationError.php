<?php

namespace App\Services\Validation;

/**
 * Class ValidationError
 * @package App\Services\Validation
 */
class ValidationError
{
    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * ValidationError constructor.
     * @param int $code
     * @param string $message
     */
    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
        ];
    }

    /**
     * @return string
     */
    public function getDisplayKey(): string
    {
        return 'errors';
    }
}
