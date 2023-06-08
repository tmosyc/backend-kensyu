<?php
namespace App\Handler;

use App\Model\Post;
use App\Service\PostService;

class GetPostDetailHandler implements HandlerInterface
{
    public function __construct(
        public string $id
    )
    {
    }

    public function run(array $req): array
    {
        $result = self::render(PostService::getPostList(), $this->id);

        return [
            'status_code' => 200,
            'body' => "<html>{$result}</html>",
        ];
    }

    private static function render(array $posts, $id): string
    {

        $post = $posts[$id];
        $body = "<body>";
        $body .="<h1>{$post->title}</h1>";
        $body .="<p>{$post->content}</p>";
        $body .="<p>{$post->author}</p>";
        $body .="</body>";
        return $body;
    }
}
