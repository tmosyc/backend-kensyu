<?php
namespace App\Handler;

use App\Model\Post;
use App\Model\UpdateArticle;
use App\Service\GetPostDetailService;
use App\Service\PostUpdateArticleService;

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
        $img_path = "../../images/article";
        $title=htmlspecialchars($post->title,ENT_QUOTES);
        $content=htmlspecialchars($post->content,ENT_QUOTES);
        $author_id=htmlspecialchars($post->author_id,ENT_QUOTES);
        $body = "<body>";
        $body .="<h1>$title</h1>";
        $body .="<p>$content</p>";
        $body .="<p>$author_id</p>";
        foreach ($post->image_array as $image_id){
            if (file_exists(dirname(__DIR__ , 2). "/images/article/{$post->id}/{$image_id}.jpg")) {
                $body .= "<img src='{$img_path}/{$post->id}/{$image_id}.jpg' width='300' height='200'>";
            } elseif (file_exists(dirname(__DIR__ , 2). "/images/article/{$post->id}/{$image_id}.png")) {
                $body .= "<img src='{$img_path}/{$post->id}/{$image_id}.png' width='300' height='200'>";
            }
        }
        $body .= "<br>";
        $body .= "<button onclick='location.href=\"/posts/{$post->id}/update\"'>update</button>";
        $body .= "<form action='/posts/{$post->id}/delete' method='post'>";
        $body .= "<input type='hidden' name='_method' value='DELETE'>";
        $body .= "<button type='submit'>delete</button>";
        $body .= "</form>";
        $body .="</body>";
        return $body;
    }
}
