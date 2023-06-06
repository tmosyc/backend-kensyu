<?php

declare(strict_types=1);

namespace App;

use App\Handler\HandlerInterface;

class Route
{
    public static function getHandler(string $method, string $path): HandlerInterface
    {
        var_dump($method);
        if ($method === 'GET' && $path === '/posts') {
            return new \App\Handler\GetPostListHandler();
        }

        return new \App\Handler\NotFoundHandler();
    }
}
