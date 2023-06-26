<?php

namespace App\Model;

class User
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
        public ?string $profile_img_name,
        public ?string $profile_img_tmp,
    )
    {
    }
}