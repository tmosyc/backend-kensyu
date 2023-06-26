<?php

namespace App\Model;

class LoginAuth
{

    public function __construct(
        public ?string $name,
        public string $email,
        public string $password,
        public ?bool $check,
    )
    {
    }
}
