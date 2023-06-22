<?php

namespace App\Service;

use App\Handler\PostUserRegisterViewHandler;
use App\Repository\PostUserRegisterRepository;
use App\Model\User;

class PostUserRegisterService
{
    public static function insertUser(User $user)
    {
        PostUserRegisterRepository::insertUser($user);
    }

    public static function image_register($image_tmp,$image_name, $profile_image_id)
    {
        if (strpos($image_name, 'jpg')) {
            $img_name = "{$profile_image_id}.jpg";
        }
        if (strpos($image_name, 'png')) {
            $img_name = "{$profile_image_id}.png";
        }
        move_uploaded_file($image_tmp, dirname(__DIR__, 2) . "/images/user/" . $img_name);
    }
}
