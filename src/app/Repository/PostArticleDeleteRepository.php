<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\EditArticle;
use App\Repository\DbConnect;
use PDO;

class PostArticleDeleteRepository
{
    public static function deleteRepo(EditArticle $deleteArticle, $pdo=null)
    {
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->prepare("DELETE FROM article WHERE article_id = :id");
        $params = array(':id' => $deleteArticle->id);
        $stmt->execute($params);
        $pdo = null;

    }
}
