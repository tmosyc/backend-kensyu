<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\PostArticleDeleteRepository;

class PostArticleDeleteService
{
    public static function deleteArticle($id)
    {
        return PostArticleDeleteRepository::deleteRepo($id);
    }
}
