<?php

declare(strict_types=1);

namespace App\Handler;

use App\Service\PostArticleDeleteService;

class PostArticleDeleteHandler implements HandlerInterface
{
    public function __construct(
        public string $id
    )
    {
    }
    public function run(array $req): array
    {
        $id = (int) $this->id;
        PostArticleDeleteService::deleteArticle($id);

        header("Location:http://localhost/posts",true, 302);
        exit();
    }
}
