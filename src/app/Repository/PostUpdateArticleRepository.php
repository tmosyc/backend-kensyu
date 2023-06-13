<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\UpdateArticle;
use PDO;

class PostUpdateArticleRepository
{
    /**
     * @param $updateArticle
     * @param $pdo
     * @return void
     */
    public static function updateArticle(UpdateArticle $updateArticle, $pdo = null): void
    {
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->prepare('UPDATE article SET title = :title, text = :content WHERE article_id = :id');
        $params = array(':id'=>$updateArticle->id, ':title' => $updateArticle->title, ':content' => $updateArticle->content);
        $stmt->execute($params);
        var_dump($stmt);
        $pdo = null;
    }
}
