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
            $select_article = $pdo->prepare("SELECT article_id, title, text, user_id, thumbnail_image_id FROM article WHERE article_id = :id");
            $select_article->bindParam(':id', $id, PDO::PARAM_INT);
            $select_article->execute();
            $results = $select_article->fetch(PDO::FETCH_ASSOC);

            $select_image = $pdo->prepare("SELECT resource_id FROM image WHERE article_id=:id");
            $select_image->bindParam(':id', $id, PDO::PARAM_INT);
            $select_image->execute();
            $image_result= $select_image->fetch(PDO::FETCH_ASSOC);

            $detail = new Post(
                id: $results['article_id'],
                title: $results['title'],
                content: $results['text'],
                author_id: $results['user_id'],
                thumbnail_image_id: $results['thumbnail_image_id'],
                image_array: $image_result['resource_id']
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
