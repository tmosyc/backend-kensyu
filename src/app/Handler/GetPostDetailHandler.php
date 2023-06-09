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
        $body = "<body>";
        $body .="<h1>{$post->title}</h1>";
        $body .="<p>{$post->content}</p>";
        $body .="<p>{$post->author}</p>";
        $body .="</body>";
        return $body;
    }
}
