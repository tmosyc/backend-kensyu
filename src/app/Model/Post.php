<?php
declare(strict_types=1);

namespace App\Model;

class Post
{
    public function __construct(
        public string $title,
        public string $content,
        public string $author,
    )
    {
    }
}
