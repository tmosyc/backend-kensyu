<?php
declare(strict_types=1);

namespace App\Service;

class PostService
{
    /**
     * @return array
     */
    public static function getPostList(): array
    {
        return PostRepository::getList();
    }
}
