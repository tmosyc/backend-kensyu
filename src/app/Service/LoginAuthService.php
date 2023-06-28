<?php

namespace App\Service;

use App\Repository\LoginAuthRepository;

class LoginAuthService
{
    public static function loginAuth($login_auth)
    {
        $login_check = LoginAuthRepository::loginAuth($login_auth);
        if (isset($login_check)) {
            if (password_verify($login_auth->password, $login_check->password)) {
                $login_check->check = true;
            } else {
                $login_check->check = false;
            }
        }
        return $login_check;
    }
}
