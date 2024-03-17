<?php

namespace App\Response;

class ErrorResponse
{
    public function __construct(
        readonly private string $message
    ) {}

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
