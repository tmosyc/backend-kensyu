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
                password: $_POST['password'],
                profile_img_name: $_FILES['profile_image']['name'],
                profile_img_tmp: $_FILES['profile_image']['tmp_name']
            );
            PostUserRegisterService::insertUser($user);
        }

        header("Location:http://localhost/posts",true, 301);
        exit();
    }

}