<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Post;
use PDO;

class InsertRepository
{
    public static function InsertText($title, $content):void
    {
        var_dump('aaaaaa');
        $dbh = new PDO('pgsql:dbname=db;host=db','root', 'root');
        $stmt = $dbh->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,1)");
        $params = array(':title' => $title, ':content' => $content);
        $stmt->execute($params);

    }
}