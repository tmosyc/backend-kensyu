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
        try {
            $dbh = new PDO('pgsql:dbname=db;host=db','root', 'root');
            $stmt = $dbh->query('SELECT * FROM article');
            $posts=[];
            while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                $post = new Post(
                    id: $row['article_id'],
                    title: $row['title'],
                    content: $row['text'],
                    author: $row['user_id']
                );
                $posts[] = $post;
            }

            $dbh = null;
        } catch (PDOException $e) {
            print "エラー!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $posts;
    }
}
