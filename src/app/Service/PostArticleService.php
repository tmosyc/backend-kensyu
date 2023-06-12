<?php
declare(strict_types=1);

namespace App\Service;
use App\Repository\PostArticleRepository;

class PostArticleService
{
    /**
     * @return array
     */
    public static function ArticlePostList($article)
    {
        return PostArticleRepository::insertArticle($article);
    }
}
