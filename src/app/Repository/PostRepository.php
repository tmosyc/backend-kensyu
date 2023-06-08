<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Post;

class PostRepository
{
    /**
     * @return Post[]
     */
    public static function getList(): array
    {
        return [
            new Post(
                id:1,
                title: 'helloworld',
                content: 'this is my first post',
                author: 'John Doe',
            ),
            new Post(
                id:2,
                title: 'helloworld2',
                content: 'this is my second post',
                author: 'John Doe',
            )
        ];
    }
}
