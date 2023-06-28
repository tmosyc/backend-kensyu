<?php

namespace App\Repository;

use App\Repository\DbConnect;

class LoggingRepo
{
    public static function logging($email, $pdo = null)
    {
        if (is_null($pdo)){
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo -> prepare('SELECT name FROM users WHERE mail_address = :email');
        $params = array(':email' => $email->email);
        $stmt ->execute($params);
        $usename = $stmt -> fetch(\PDO::FETCH_ASSOC)['name'];
        return $usename;
    }
}