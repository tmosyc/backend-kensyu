<?php

namespace App\Service;

use App\Repository\LoginAuthRepository;

class LoginAuthService
{
    public static function loginAuth($login_auth){
        $login_check = LoginAuthRepository::loginAuth($login_auth);
        if (password_verify($login_auth->password, $login_check->password)){
            $login_check->check = true;
            return $login_check;
        } else {
            $login_check->check=false;
            return $login_check;
        }
    }
}
