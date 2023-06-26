<?php

namespace App\Service;

use App\Handler\PostUserRegisterViewHandler;
use App\Repository\PostUserRegisterRepository;
use App\Model\User;

class PostUserRegisterService
{
    /**
     * @param User $user
     * @property string $username,
     * @property string $email,
     * @property string $password,
     * @property ?string $profile_img_name,
     * @property ?string $profile_img_tmp,
     * @return void
     */
    public static function insertUser(User $user)
    {
        $last_id = PostUserRegisterRepository::insertUser($user);
        if (isset($last_id)) {
            self::image_upload($user->profile_img_tmp, $user->profile_img_name, $last_id);
        }
    }

    /**
     * @param $image_tmp
     * @param $image_name
     * @param $profile_image_id
     * @return void
     */

    public static function image_upload($image_tmp,$image_name, $profile_image_id)
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
