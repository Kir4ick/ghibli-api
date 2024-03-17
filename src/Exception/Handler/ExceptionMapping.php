<?php

namespace App\Exception\Handler;

class ExceptionMapping
{
    public function __construct(
        readonly private int $code,
        readonly private bool $hidden,
        readonly private bool $loggable
    ) {}

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * @return bool
     */
    public function isLoggable(): bool
    {
        return $this->loggable;
    }
}
