<?php
declare(strict_types=1);

namespace App\Model;
class Post
{
    /**
     * @param int $id
     * @param string $title
     * @param string $content
     * @param string $author_name
     * @param ?int $thumbnail_image_id
     * @param ?array $image_array
     */
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
        public string $author_name,
        public ?int $thumbnail_image_id,
        public ?array $image_array,
    )
    {
    }
}
