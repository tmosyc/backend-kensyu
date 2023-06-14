<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\PostArticleDeleteRepository;

class PostArticleDeleteService
{
    public static function deleteArticle($deleteArticle)
    {
        return PostArticleDeleteRepository::deleteRepo($deleteArticle);
    }
}
