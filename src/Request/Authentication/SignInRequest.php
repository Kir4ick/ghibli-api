<?php

namespace App\Request\Authentication;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignInRequest
{
    #[NotBlank(message: 'Логин не может быть пустым')]
    #[Length(
        min: 4,
        max: 255,
        minMessage: 'Поле не может быть короче 4 символов',
        maxMessage: 'Поле не может быть длиннее 255 символов'
    )]
    private string $login;

    #[Length(
        min: 4,
        max: 255,
        minMessage: 'Поле не может быть короче 4 символов',
        maxMessage: 'Поле не может быть длиннее 255 символов'
    )]
    private string $password;
}
