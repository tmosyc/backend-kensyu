<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\EditArticle;
use App\Repository\PostUpdateArticleRepository;

class PostUpdateArticleService
{
    /**
     * @return array
     */
    public static function postUpdateArticle(EditArticle $updateArticle)
    {
        return PostUpdateArticleRepository::updateArticle($updateArticle);
    }
}
