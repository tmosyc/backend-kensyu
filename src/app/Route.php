<?php

declare(strict_types=1);

namespace App;

use App\Handler\HandlerInterface;
use App\Handler\GetPostListHandler;
use App\Handler\GetPostDetailHandler;
use App\Handler\NotFoundHandler;

class Route
{
    /**
     * @param string $method
     * @param string $path
     * @return HandlerInterface
     */
    public static function getHandler(string $method, string $path,): HandlerInterface
    {
        $id = explode('/', $path)[2];
        if ($method === 'GET' && $path === '/posts') {
            var_dump($path);
            return new GetPostListHandler;
        }
        if ($method === 'GET' && $path === "/posts/{$id}") {
            return  new GetPostDetailHandler($id);
        }

        return new NotFoundHandler;
    }
}
