<?php

declare(strict_types=1);

namespace App\Handler;

use App\Model\UpdateArticle;
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
        $deleteArticle = new UpdateArticle(id:$id,title: '',content: '');
        PostArticleDeleteService::deleteArticle($deleteArticle);

        header("Location:http://localhost/posts",true, 301);
        exit();
    }
}
