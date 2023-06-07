<?php

declare(strict_types=1);

namespace App;

use App\Handler\HandlerInterface;
use App\Handler\GetPostListHandler;
use App\Handler\NotFoundHandler;

class Route
{
    /**
     * @param string $method
     * @param string $path
     * @return HandlerInterface
     */
    public static function getHandler(string $method, string $path): HandlerInterface
    {
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListHandler;
        }

        return new NotFoundHandler;
    }
}
