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
    public static function getList(): array
    {
        $dbh = DbConnect::dbConnect();
        $stmt = $dbh->query('SELECT * FROM article');
        $posts = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post = new Post(
                id: $row['article_id'],
                title: $row['title'],
                content: $row['text'],
                author: $row['user_id']
            );
            $posts[] = $post;
        }

        $dbh = null;

        return $posts;
    }
}
