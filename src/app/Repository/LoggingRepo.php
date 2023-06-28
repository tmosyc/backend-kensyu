<?php

namespace App\Repository;

use App\Repository\DbConnect;
use PDO;

class LoggingRepo
{
    public static function logging($email, $pdo = null)
    {
        if (is_null($pdo)){
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo -> prepare('SELECT name, mail_address FROM users WHERE mail_address = :email');
        $params = array(':email' => $email);
        $stmt ->execute($params);
        $row = $stmt -> fetch(PDO::FETCH_ASSOC);
        if ($row !== false) {
            $username = $row['name'];
        }
        return $username;
    }
}
