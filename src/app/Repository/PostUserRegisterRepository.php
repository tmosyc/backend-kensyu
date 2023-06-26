<?php

namespace App\Repository;

use App\Service\PostUserRegisterService;
use PDO;
use App\Repository\DbConnect;

class PostUserRegisterRepository
{
    /**
     * @param $user
     * @property string $username,
     * @property string $email,
     * @property string $password,
     * @property ?string $profile_img_name,
     * @property ?string $profile_img_tmp,
     * @param $pdo
     * @return void
     */
    public static function insertUser($user, $pdo = null)
    {
        if ($pdo === null) {
            $pdo = DbConnect::dbConnect();
        }

        $insert_user = $pdo->prepare('INSERT INTO users (name,password,mail_address,profile_image_id) VALUES (:username,:password,:email,null) RETURNING user_id');
        $params = array(':username' => $user->username, ':email' => $user->email, ':password' => $user->password);
        $insert_user->execute($params);
        $user_last_id = $insert_user->fetch(PDO::FETCH_ASSOC)['user_id'];

        if (isset($user->profile_img_name)) {
            $update_image_id = $pdo->prepare('UPDATE users SET profile_image_id=:last_id WHERE user_id =:last_id');
            $params = array(':last_id' => $user_last_id);
            $update_image_id->execute($params);
        }
        PostUserRegisterService::image_upload($user->profile_img_tmp, $user->profile_img_name, $user_last_id);
    }
}