<?php
declare(strict_types=1);

namespace App\Service;
use App\Repository\PostArticleRepository;

class PostArticleService
{
    /**
     * @param $article
     * @return array|null
     */
    public static function ArticlePostList($article)
    {
        return PostArticleRepository::insertArticle($article);
    }
}
