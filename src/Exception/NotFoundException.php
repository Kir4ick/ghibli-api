<?php

namespace App\Exception;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotFoundException extends Exception
{
    public function __construct(string $message = 'not found')
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND, null);
    }
}
