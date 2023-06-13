<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\UpdateArticle;
use App\Repository\PostUpdateArticleRepository;

class PostUpdateArticleService
{
    /**
     * @return array
     */
    public static function postUpdateArticle(UpdateArticle $updateArticle)
    {
        return PostUpdateArticleRepository::updateArticle($updateArticle);
    }
}
