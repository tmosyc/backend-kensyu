<?php

namespace App\Handler;

use App\Model\LoginAuth;
use App\Service\LoginAuthService;

class LoginHandler implements HandlerInterface
{
    public function run(array $req): array
    {
        $login_auth = new LoginAuth(
            email: $_POST['login_email'],
            password: $_POST['login_password'],
        );
        $user_auth = LoginAuthService::loginAuth($login_auth);
        if ($user_auth != null) {
            if ($user_auth->check === true) {
                $_SESSION['username'] = $user_auth->name;
                $_SESSION['email'] = $user_auth->email;
                header("Location:http://localhost/posts", true, 302);
            } else {
                header("Location:http://localhost/login", true, 302);
            }
        } else {
            header("Location:http://localhost/login", true, 302);
        }
        exit();
    }
}
