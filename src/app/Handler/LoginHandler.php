<?php

declare(strict_types=1);

namespace App\Handler;

class LoginHandler implements HandlerInterface
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
        $body .= "<form action='/post' method='post'>";
        $body .= "<input type='email' name='email' placeholder='メールアドレス'>";
        $body .= "<input type='text' name='password' placeholder='パスワード'>";
        $body .= "<button type='submit' name='register'>Sign Up</button>";
        $body .= "</form>";
        $body .= "</body>";

        return $body;
    }
}
