<?php
declare(strict_types=1);

namespace App\Model;
class Post
{
    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param int $author_id
     */
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public int $author_id,
        public ?int $thumbnail_image_id,
        public ?array $image_array
    )
    {
    }
}
