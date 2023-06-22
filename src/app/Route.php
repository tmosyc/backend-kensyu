<?php

declare(strict_types=1);

namespace App;

use App\Handler\HandlerInterface;
use App\Handler\GetPostListHandler;
use App\Handler\GetPostDetailHandler;
use App\Handler\NotFoundHandler;
use App\Handler\PostArticleHandler;
use App\Handler\PostUpdateArticleViewHandler;
use App\Handler\PostUserRegisterViewHandler;
use App\Handler\PutUpdateArticleHandler;
use App\Handler\PostArticleDeleteHandler;
use App\Handler\PostUserRegisterHandler;

class Route
{
    /**
     * @param string $method
     * @param string $path
     * @return HandlerInterface
     */
    public static function getHandler(string $method, string $path,): HandlerInterface
    {
        if (strpos($path,'post/')){
            $id = explode('/', $path)[2];
        }
        if ($method=== 'GET' && $path === '/register') {
            return new PostUserRegisterViewHandler();
        }
        if ($method=== 'POST' && $path === '/register') {
            return new PostUserRegisterHandler();
        }
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListHandler;
        }
        if ($method === 'GET' && $path === "/posts/{$id}") {
            return new GetPostDetailHandler($id);
        }
        if ($method === 'POST' && $path === "/posts") {
            return new PostArticleHandler;
        }
        if ($method === 'GET' && $path === "/posts/{$id}/update"){
            return new PostUpdateArticleViewHandler($id);
        }
        if ($method === 'POST' && $_POST['_method'] === 'PUT' && $path === "/posts/{$id}"){
            return new PutUpdateArticleHandler($id);
        }
        if ($method === 'POST' && $path === "/posts/{$id}") {
            return new GetPostDetailHandler($id);
        }
        if ($method === 'POST' && $_POST['_method'] === 'DELETE' && $path === "/posts/{$id}/delete"){
            return new PostArticleDeleteHandler($id);
        }

        return new NotFoundHandler;
    }
}
