<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use App\Model\Post;

class InsertRepository
{
    public static function InsertText($title, $content):void
    {
        $dbh = DbConnect::dbConnect();
        $stmt = $dbh->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,1)");
        $params = array(':title' => $title, ':content' => $content);
        $stmt->execute($params);

    }
}
