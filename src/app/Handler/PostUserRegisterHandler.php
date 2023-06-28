<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\PostUserRegisterService;
use App\Model\User;

class PostUserRegisterHandler implements HandlerInterface
{
    /**
     * @param array $req Request
     * @return array Response
     */
    public function run(array $req): array
    {
        //user登録
        if (isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password'])) {
            $user = new User(
                username: $_POST['username'],
                email: $_POST['email'],
                password: password_hash($_POST['password'],PASSWORD_DEFAULT),
                profile_img_name: $_FILES['profile_image']['name'],
                profile_img_tmp: $_FILES['profile_image']['tmp_name']
            );
            PostUserRegisterService::insertUser($user);

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
        }

        header("Location:http://localhost/posts",true, 302);
        exit();
    }
}
