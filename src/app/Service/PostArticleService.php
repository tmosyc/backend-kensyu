<?php
declare(strict_types=1);

namespace App\Service;
use App\Repository\PostArticleRepository;
use App\Model\Article;

class PostArticleService
{
    /**
     * @return array
     */
    public static function ArticlePostList($article)
    {
        return PostArticleRepository::InsertArticle($article);
    }
}