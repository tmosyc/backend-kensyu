<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Post;
use http\QueryString;
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
        $query = 'SELECT article_id,title,text,name,thumbnail_image_id 
                    FROM article INNER JOIN users ON article.user_id = users.user_id
                        ORDER BY article_id';

        $stmt = $pdo->query($query);

        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                id: $row['article_id'],
                title: $row['title'],
                content: $row['text'],
                author_name: $row['name'],
                thumbnail_image_id:$row['thumbnail_image_id'],
                image_array:null
            );
            $posts[] = $post;
        }
        $pdo = null;
        return $posts;
    }
}
