<?php
declare(strict_types=1);

namespace App\Model;
class Post
{
    /**
     * @param string $title
     * @param string $content
     * @param string $author
     */
    public function __construct(
        public string $title,
        public string $content,
        public string $author,
    )
    {
    }
}
