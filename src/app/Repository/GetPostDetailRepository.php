<?php

declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use Exception;
use PDO;
use App\Model\Post;

class GetPostDetailRepository
{
    public static function selectArticleDetail($id, PDO $pdo = null)
    {
        try {
            if (is_null($pdo)) {
                $pdo = DbConnect::dbConnect();
            }
            $pdo->beginTransaction();

            $query = 'SELECT article_id, title, text, name, thumbnail_image_id 
                        FROM article INNER JOIN users ON article.user_id = users.user_id 
                        WHERE article_id = :id';
            $select_article = $pdo->prepare($query);
            $select_article->bindParam(':id', $id, PDO::PARAM_INT);
            $select_article->execute();
            $results = $select_article->fetch(PDO::FETCH_ASSOC);

            $select_image = $pdo->prepare("SELECT article_id, resource_id FROM image WHERE article_id=:id");
            $select_image->bindParam(':id', $id, PDO::PARAM_INT);
            $select_image->execute();
            $image_array = [];
            while ($row = $select_image->fetch(PDO::FETCH_ASSOC)) {
                $image_array[] = $row['resource_id'];
            }

            $detail = new Post(
                id: $results['article_id'],
                title: $results['title'],
                content: $results['text'],
                author_name: $results['name'],
                thumbnail_image_id: $results['thumbnail_image_id'],
                image_array: $image_array
            );

            if ($select_image && $select_article) {
                $pdo->commit();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            $pdo->rollBack();
        } finally {
            $pdo = null;
            return $detail;
        }
    }
}
