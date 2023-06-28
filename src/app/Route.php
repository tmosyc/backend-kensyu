<?php

declare(strict_types=1);

namespace App;

use App\Handler\GetPostDetailHandler;
use App\Handler\GetPostListHandler;
use App\Handler\HandlerInterface;
use App\Handler\LoginHandler;
use App\Handler\LoginViewHandler;
use App\Handler\LogoutHandler;
use App\Handler\NotFoundHandler;
use App\Handler\PostArticleDeleteHandler;
use App\Handler\PostArticleHandler;
use App\Handler\PostUpdateArticleViewHandler;
use App\Handler\PostUserRegisterHandler;
use App\Handler\PostUserRegisterViewHandler;
use App\Handler\PutUpdateArticleHandler;
use Exception;

session_start();

class Route
{
    /**
     * @param string $method
     * @param string $path
     * @return HandlerInterface
     */
    public static function getHandler(string $method, string $path,): HandlerInterface
    {
        if (strpos($path,'posts/')){
            $id = explode('/', $path)[2];
            if (is_int((int) $id)){
                return new NotFoundHandler();
            }
        }
        if ($method === 'GET' && $path === '/register') {
            return new PostUserRegisterViewHandler();
        }
        if ($method === 'POST' && $path === '/register') {
            return new PostUserRegisterHandler();
        }
        if ($method === 'GET' && $path === '/login') {
            return new LoginViewHandler();
        }
        if ($method === 'POST' && $path === '/login') {
            return new LoginHandler();
        }
        if ($method === 'GET' && $path === "/logout") {
            return new LogoutHandler;
        }
        if ($method === 'GET' && $path === '/posts') {
            return new GetPostListHandler;
        }
        if ($method === 'POST' && $path === "/posts") {
            if (isset($_SESSION['username'])) {
                return new PostArticleHandler;
            } else {
                return new GetPostListHandler;
            }
        }
        if (isset($id)) {
            if ($method === 'GET' && $path === "/posts/{$id}") {
                return new GetPostDetailHandler($id);
            }
            if ($method === 'GET' && $path === "/posts/{$id}/update") {
                if (isset($_SESSION['username'])) {
                    return new PostUpdateArticleViewHandler($id);
                } else {
                    return new GetPostDetailHandler($id);
                }
            }
            if ($method === 'POST' && $_POST['_method'] === 'PUT' && $path === "/posts/{$id}") {
                return new PutUpdateArticleHandler($id);
            }
            if ($method === 'POST' && $path === "/posts/{$id}") {
                return new GetPostDetailHandler($id);
            }
            if ($method === 'POST' && $_POST['_method'] === 'DELETE' && $path === "/posts/{$id}/delete") {
                if (isset($_SESSION['username'])) { //&& $_SESSION['username'] ===
                    return new PostArticleDeleteHandler($id);
                } else {
                    return new GetPostDetailHandler($id);
                }
            }
        }
        return new NotFoundHandler;
    }
}
