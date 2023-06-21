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
        $image_name_array = $article ->image_name;
        if (is_null($article->thumbnail_check)) {
            $thumbnail_id = null;
        } else {
            $thumbnail_id = array_search($article->thumbnail_check, $image_name_array);
        }
        return PostArticleRepository::insertArticle($article, $thumbnail_id);
    }
}
