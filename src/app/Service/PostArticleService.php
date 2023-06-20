<?php
declare(strict_types=1);

namespace App\Service;
use App\Repository\PostArticleRepository;

class PostArticleService
{
    /**
     * @param $article
     * @property string $title,
     * @property string $content,
     * @property array $image_name,
     * @property array $image_tmp_name,
     * @property ?array $tag_id
     * @return void
     */
    public static function ArticlePostList($article)
    {
        return PostArticleRepository::insertArticle($article);
    }
}