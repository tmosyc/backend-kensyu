<?php

namespace App\Service;

use App\Handler\PostUserRegisterViewHandler;
use App\Repository\PostUserRegisterRepository;
use App\Model\User;

class PostUserRegisterService
{
    public static function insertUser(User $user)
    {
        $max_id=PostUserRegisterRepository::maxUserId();
        $max_id=$max_id+1;
        if (strpos($user->profile_img_name, 'jpg')) {
            $img_name = "{$max_id}.jpg";
        }
        if (strpos($user->profile_img_name, 'png')) {
            $img_name = "{$max_id}.png";
        }
        $user->profile_img_name = $img_name;
        move_uploaded_file($user->profile_img_tmp, dirname(__DIR__, 2) . "/images/user/" . $img_name);
        PostUserRegisterRepository::insertUser($user, $max_id);
    }
}
