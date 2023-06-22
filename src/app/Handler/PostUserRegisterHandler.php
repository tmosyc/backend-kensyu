<?php
declare(strict_types=1);
namespace App\Handler;

class PostUserRegisterHandler implements HandlerInterface
{
    public function run(array $req): array
    {
        $result = self::render();

        return [
            'status_code' => 200,
            'body' => "<html>{$result}</html>",
        ];
    }

    public static function render()
    {
        $body = "<body>";
        $body .= "<form action='/posts' method='post' enctype='multipart/form-data'>";
        $body .= "<input type='text' name='username' placeholder='ユーザー名'>";
        $body .= "<input type='email' name='email' placeholder='メールアドレス'>";
        $body .= "<input type='text' name='password' placeholder='パスワード'>";
        $body .= "<input type='file' name='profile_image' accept='image/*'>";
        $body .= "<button type='submit' name='register'>Sign Up</button>";
        $body .= "</form>";
        $body .= "</body>";

        return $body;
    }
}
