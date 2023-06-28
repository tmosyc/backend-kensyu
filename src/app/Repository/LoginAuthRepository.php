<?php

namespace App\Repository;

use App\Model\LoginAuth;
use PDO;
class LoginAuthRepository
{
    public static function loginAuth($login_auth, $pdo=null)
    {
        if (is_null($pdo)){
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->prepare("SELECT name, mail_address, password FROM users WHERE mail_address=:email");
        $params = array(':email' => $login_auth->email);
        $stmt->execute($params);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $login_check = new LoginAuth(
                name:$row['name'],
                email:$row['mail_address'],
                password: $row['password'],
            );
        }
        if (empty($login_check)){
            $login_check = null;
        }
        return $login_check;
    }
}
