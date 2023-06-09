<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\Post;
use App\Service\PostService;
use App\Repository\InsertRepository;

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
        $body = "<body>";
        $body .= "<h1>記事一覧</h1>";
        $body .= "<form action='/posts' method='post'>";
        $body .= "<input type='text' name='title' size=25 placeholder='タイトルを入力してください'> ";
        $body .= "<input type='text' name='content' size=30 placeholder='内容を入力してください'> ";
        $body .= "<button type='submit' name='content_post'>submit</button> ";
        $body .= "</form>";
        foreach ($posts as $post) {
            $id = $post-> id;
            $id = (int) $id - 1;
            $id = (string) $id;
            $body .= "<a href=posts/{$id}>{$post->title}</a>";
            $body .= "<br>";
        }
        $body .= "</body>";

        return $body;
    }
}
