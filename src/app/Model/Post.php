<?php
declare(strict_types=1);

namespace App\Model;
class Post
{
    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param string $author
     */
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public int $author,
    )
    {
    }
}
