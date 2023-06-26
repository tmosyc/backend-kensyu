<?php
declare(strict_types=1);

namespace App\Handler;

class LogoutHandler implements HandlerInterface
{
    public function run(array $req): array
    {
        $_SESSION = [];
        session_destroy();
        header("Location:http://localhost/posts",true, 301);
        exit();
    }
}
