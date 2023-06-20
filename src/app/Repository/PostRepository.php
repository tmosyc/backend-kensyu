<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Post;
use PDO;

class PostRepository
{
    /**
     * @return Post[]
     */
    public static function getList(PDO $pdo = null): array
    {
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->query('SELECT article_id,title,text,user_id,thumbnail_image_id FROM article ORDER BY article_id');
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                id: $row['article_id'],
                title: $row['title'],
                content: $row['text'],
                author_id: $row['user_id'],
                thumbnail_image_id:$row['thumbnail_image_id'],
                image_array:null,
            );
            $posts[] = $post;
        }
        $pdo = null;
        return $posts;
    }
}
