<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\UpdateArticle;
use App\Service\GetPostDetailService;
use App\Service\PostUpdateArticleService;

class PutUpdateArticleHandler implements HandlerInterface
{
    public function __construct(
        public string $id
    )
    {
    }

    public function run(array $req): array
    {
        if (isset($_POST["update_title"], $_POST['update_content'])){
            $updateArticle = new UpdateArticle(id:(int) $this->id , title: $_POST['update_title'], content: $_POST['update_content']);
            PostUpdateArticleService ::postUpdateArticle($updateArticle);
        }

        $result = self::render(GetPostDetailService::getPostArticleDetail($this->id));

        return [
            'status_code' => 200,
            'body' => "<html>{$result}</html>",
        ];
    }
    private static function render($post): string
    {
        $title=htmlspecialchars($post->title,ENT_QUOTES);
        $content=htmlspecialchars($post->content,ENT_QUOTES);
        $author_id=htmlspecialchars((string) $post->author_id,ENT_QUOTES);
        $body = "<body>";
        $body .="<h1>$title</h1>";
        $body .="<p>$content</p>";
        $body .="<p>$author_id</p>";
        $body .= "<form action='/posts/{$post->id}/update' method='post'>";
        $body .= "<button type='submit'>update</button>";
        $body .= "</form>";
        $body .="</body>";
        return $body;
    }
}