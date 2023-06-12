<?php
namespace App\Handler;

use App\Model\Post;
use App\Service\GetPostDetailService;

class GetPostDetailHandler implements HandlerInterface
{
    public function __construct(
        public string $id
    )
    {
    }

    public function run(array $req): array
    {
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
        $author_id=htmlspecialchars($post->author_id,ENT_QUOTES);
        $body = "<body>";
        $body .="<h1>$title</h1>";
        $body .="<p>$content</p>";
        $body .="<p>$author_id</p>";
        $body .="</body>";
        return $body;
    }
}
