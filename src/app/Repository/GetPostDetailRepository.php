<?php


declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use PDO;
use App\Model\Post;

class GetPostDetailRepository
{
    public static function selectArticleDetail($id, PDO $pdo = null)
    {
        var_dump($id);
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->prepare("SELECT article_id, title, text, user_id FROM article WHERE article_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $detail = new Post(
            id: $results['article_id'],
            title: $results['title'],
            content: $results['text'],
            author_id: $results['user_id'],
        );
        $pdo = null;

        return $detail;

    }
}
