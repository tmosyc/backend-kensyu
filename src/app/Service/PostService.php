<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\PostRepository;

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
