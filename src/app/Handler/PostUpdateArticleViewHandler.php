<?php
declare(strict_types=1);

namespace App\Handler;

use App\Model\Logging;
use App\Model\UpdateArticle;
use App\Service\LoggingService;
use App\Service\PostUpdateArticleService;

class PostUpdateArticleViewHandler implements HandlerInterface
{
    public function __construct(
        public string $id
    )
    {
    }

    public function run(array $req): array
    {
        $login_name = LoggingService::logging($_SESSION['email']);
        $result = self::render($this->id, $login_name);

        return [
            'status_code' => 200,
            'body' => "<html>{$result}</html>",
        ];
    }

    public static function render($id, $logging_name)
    {
        $body = "<body>";
        $body .= "<form method='post' action='/posts/{$id}'>";
        $body .= "<input type='hidden' name='_method' value='PUT'>";
        $body .= "<input type='hidden' name='username' value={$logging_name}>";
        $body .= "<input type='text' name='update_title' size=25 placeholder='タイトルを入力してください'> ";
        $body .= "<input type='text' name='update_content' size=30 placeholder='内容を入力してください'> ";
        $body .= "<button type='submit' name='content_update'>update</button> ";
        $body .= "</form>";
        $body .= "<form action='/posts/{$id}/delete' method='post'>";
        $body .= "<input type='hidden' name='_method' value='DELETE'>";
        $body .= "<input type='hidden' name='username' value={$logging_name}>";
        $body .= "<button type='submit'>delete</button>";
        $body .= "</form>";
        $body .= "</body>";

        return $body;
    }
}
