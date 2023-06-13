<?php
declare(strict_types=1);

namespace App\Handler;

use App\Model\UpdateArticle;
use App\Service\PostUpdateArticleService;


class PostUpdateArticleHandler implements HandlerInterface
{
    public function __construct(
        public string $id
    )
    {
    }
    public function run(array $req): array
    {
        $updateArticle = new UpdateArticle(id:(int) $this->id , title: $_POST['update_title'], content: $_POST['update_content']);
        PostUpdateArticleService ::postUpdateArticle($updateArticle);

        $result = self::render($this->id);

        return [
            'status_code' => 200,
            'body' => "<html>{$result}</html>",
        ];
    }
    public function render($post)
    {
        $body = "<body>";
        $body .= "<form action='/posts/{$post}' method='get'>";
        $body .= "<input type='text' name='update_title' size=25 placeholder='タイトルを入力してください'> ";
        $body .= "<input type='text' name='update_content' size=30 placeholder='内容を入力してください'> ";
        $body .= "<button type='submit' name='content_update'>update</button> ";
        $body .= "</form>";
        $body .= "</body>";

        return $body;
    }
}
