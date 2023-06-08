<?php

declare(strict_types=1);

namespace App;

use App\Handler\HandlerInterface;
use App\Handler\GetPostListHandler;
use App\Handler\GetPostDetailHandler;
use App\Handler\NotFoundHandler;
use App\Repository\InsertRepository;

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
            return new GetPostListHandler;
        }
        if ($method === 'GET' && $path === "/posts/{$id}") {
            return  new GetPostDetailHandler($id);
        }
        if ($method === 'POST' && $path === "/posts") {
            var_dump('post');
            InsertRepository::InsertText($_POST['title'],$_POST['content']);
            return new GetPostListHandler;
        }


        return new NotFoundHandler;
    }
}
