<?php

namespace App\Repository;

use App\Service\PostUserRegisterService;
use PDO;
use App\Repository\DbConnect;
use PDOException;

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
        try {
            if ($pdo === null) {
                $pdo = DbConnect::dbConnect();
            }

            $pdo -> beginTransaction();

            $insert_user = $pdo->prepare('INSERT INTO users (name,password,mail_address,profile_image_id) VALUES (:username, :email, :password,null) RETURNING user_id');
            $params = array(':username' => $user->username, ':email' => $user->email, ':password' => $user->password);
            $insert_user->execute($params);
            $user_last_id = $insert_user->fetch(PDO::FETCH_ASSOC)['user_id'];

            if (isset($user->profile_img_name)) {
                $update_image_id = $pdo->prepare('UPDATE users SET profile_image_id=:last_id WHERE user_id =:last_id');
                $params = array(':last_id' => $user_last_id);
                $update_image_id->execute($params);
            }

            if ($insert_user && $update_image_id) {
                $pdo->commit();
                return $user_last_id;
            }
        } catch(PDOException $e) {
            $pdo->rollBack();
        } finally {
            $pdo = null;
        }
    }
}
