<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;


class PostImageRepository
{
    public static function postInsertImage($image_array, $pdo = null)
    {
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,1)");
        $params = array(':title' => $article->title, ':content' => $article->content);
        $stmt->execute($params);
        $pdo = null;

    }
}
