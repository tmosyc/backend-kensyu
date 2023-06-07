<?php

namespace App\Handler;

class NotFoundHandler implements HandlerInterface
{
    /**
     *　NotFoundHandler constructor
     */
    public function __construct()
    {
    }

    /**
     * @param array $req
     * @return array
     */
    public function run(array $req): array
    {
        return [
            "status_code" => 404,
            "body" => "<html>Not Found.</html>"
        ];
    }
}
