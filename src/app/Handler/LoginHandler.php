<?php

namespace App\Handler;

use App\Model\LoginAuth;
use App\Service\LoginAuthService;

session_start();

class LoginHandler implements HandlerInterface
{
    public function run(array $req): array
    {
        $login_auth = new LoginAuth(
            name: null,
            email: $_POST['login_email'],
            password:$_POST['login_password'],
            check: null
        );
        $user_auth = LoginAuthService::loginAuth($login_auth);
        if ($user_auth->check === true) {
            $_SESSION['username'] = $user_auth->name;
            header("Location:http://localhost/posts",true, 301);
        } else {
            header("Location:http://localhost/login", true, 301);
        }
        exit();
    }
}
