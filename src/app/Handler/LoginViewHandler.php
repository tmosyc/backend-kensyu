<?php

declare(strict_types=1);

namespace App\Handler;

class LoginViewHandler implements HandlerInterface
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
        $body .= "<form action='/login' method='post'>";
        $body .= "<input type='email' name='login_email' placeholder='メールアドレス'>";
        $body .= "<input type='text' name='login_password' placeholder='パスワード'>";
        $body .= "<button type='submit' name='register'>Login</button>";
        $body .= "</form>";
        $body .= "</body>";
        return $body;
    }
}
