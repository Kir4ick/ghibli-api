<?php

namespace App\Services\Authentication\Interfaces;

use App\DTO\Authentication\SignInDTO;
use App\DTO\Authentication\SignUpDTO;

interface AuthenticationInterface
{
    public function signUp(SignUpDTO $input);

    public function signIn(SignInDTO $input);
}
