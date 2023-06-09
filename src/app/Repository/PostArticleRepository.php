<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use App\Model\Post;

class PostArticleRepository
{
    public static function insertArticle($article):void
    {
        $dbh = DbConnect::dbConnect();
        $stmt = $dbh->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,1)");
        $params = array(':title' => $article -> title, ':content' => $article-> content);
        $stmt->execute($params);
    }
}
