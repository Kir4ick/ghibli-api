<?php

namespace App\DTO\Authentication;

class SignInDTO
{
    public function __construct(
        private readonly string $login,
        private readonly string $password
    ){}

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
