<?php

namespace App\Repository;

use PDO;
use App\Repository\DbConnect;

class PostUserRegisterRepository
{
    public static function insertUser($user, $max_id, $pdo=null)
    {
        if ($pdo === null) {
            $pdo = DbConnect::dbConnect();
        }
        $insert_user = $pdo->prepare('INSERT INTO users (name,password,mail_address,profile_image_id) VALUES (:username, :email, :password,:profile_image_id)');
        $params = array(':username' => $user->username, ':email'=>$user->email, ':password'=>$user->password, ':profile_image_id'=>$max_id);
        $insert_user->execute($params);
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
