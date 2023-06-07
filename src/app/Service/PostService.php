<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\PostRepository;

class PostService
{
    public static function getPostList(): array
    {
        return PostRepository::getList();
    }
}

// ビジネスロジック。staticとは