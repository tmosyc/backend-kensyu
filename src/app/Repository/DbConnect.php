<?php

namespace App\Repository;
use Dotenv\Dotenv;
use PDO;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class DbConnect
{
    public static function dbConnect()
    {
        try{
        $pdo = new PDO('pgsql:dbname=db;host=db', $_ENV['POSTGRES_USER'], $_ENV['POSTGRES_PASSWORD']);
        } catch (PDOException $e) {
            print "エラー!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $pdo;
    }
}
