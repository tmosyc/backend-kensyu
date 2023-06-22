<?php

namespace App\Repository;

use App\Service\PostUserRegisterService;
use PDO;
use App\Repository\DbConnect;

class PostUserRegisterRepository
{
    public static function insertUser($user,$pdo=null)
    {
        if ($pdo === null) {
            $pdo = DbConnect::dbConnect();
        }

        $insert_user = $pdo->prepare('INSERT INTO users (name,password,mail_address,profile_image_id) VALUES (:username, :email, :password,null) RETURNING user_id');
        $params = array(':username' => $user->username, ':email' => $user->email, ':password' => $user->password);
        $insert_user->execute($params);
        $user_last_id = $insert_user->fetch(PDO::FETCH_ASSOC)['user_id'];

        if (isset($user->profile_img_name)) {
            $update_image_id = $pdo->prepare('UPDATE users SET profile_image_id=:last_id WHERE user_id =:last_id');
            $params = array(':last_id'=> $user_last_id);
            $update_image_id->execute($params);
        }
        PostUserRegisterService::image_register($user->profile_img_tmp, $user->profile_img_name,$user_last_id);

    }
    public static function maxUserId($pdo=null)
    {
        if ($pdo === null) {
            $pdo = DbConnect::dbConnect();
        }
        $max_id = $pdo->query('SELECT MAX(user_id) as max_id FROM users');
        $result = $max_id->fetch(PDO::FETCH_ASSOC);
        return $result['max_id'];
    }
}
