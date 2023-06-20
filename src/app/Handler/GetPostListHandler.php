<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Post;
use App\Service\PostService;
use App\Service\PostArticleService;

class GetPostListHandler implements HandlerInterface
{
    /**
     * @param array $req Request
     * @return array Response
     */
    public function run(array $req): array
    {
        $result = self::render(PostService::getPostList());

        return [
            "status_code" => 200,
            "body" => "<html>{$result}</html>"
        ];
    }

    /**
     * @param Post[] $posts
     * @return string
     */
    private static function render(array $posts): string
    {
        $tags = ['総合','テクノロジー','モバイル','アプリ','エンタメ','ビューティー','ファッション','ライフスタイル','ビジネス','グルメ','スポーツ'];
        $img_path = "../../images/article";
        $body = "<body>";
        $body .= "<h1>記事一覧</h1>";
        $body .= "<form action='/posts' method='post' enctype='multipart/form-data'>";
        $body .= "<input type='text' name='title' size=25 placeholder='タイトルを入力してください'> ";
        $body .= "<input type='text' name='content' size=30 placeholder='内容を入力してください'> ";
        $body .= "<input type='file' id='images' name='images[]' accept='image/*' multiple>";
        $body .= "<select name='tags[]' multiple>";
        foreach ($tags as $i => $tag){
            $i=$i+1;
            $body .= "<option value={$i}>{$tag}</option>";
        }
        $body .= "</select>";
        $body .= "<h5 class='image-attribute'></h5>";
        $body .= "<button type='submit' name='content_post'>submit</button> ";
        $body .= "</form>";
        $body .= "<script src='./../../js/ImageNameDisplay.js'></script>";

        foreach ($posts as $post) {
            $title = htmlspecialchars($post->title);
            $body .= "<a href=posts/{$post->id}>$title</a>";
            if (isset($post->thumbnail_image_id)) {
                $body .= "<img src='{$img_path}/{$post->id}/{$post->thumbnail_image_id}.jpg' width='300' height='200'>";
            }
            $body .= "<br>";
        }
        $body .= "</body>";

        return $body;
    }
}
