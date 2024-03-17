<?php

namespace App\Exception;

class RequestBodyConvertException extends \Exception
{
    public function __construct(\Throwable $exception)
    {
        parent::__construct("Ошибка во время конвертация json контента", 0, $exception);
    }
}
