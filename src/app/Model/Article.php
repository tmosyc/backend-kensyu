<?php
declare(strict_types=1);

namespace App\Model;
class Article
{
    /**
     * @param string $title
     * @param string $content
     * @param string $author_name
     * @param array $image_name
     * @param array $image_tmp_name
     * @param array|null $tag_id
     * @param string|null $thumbnail_check
     */
    public function __construct(
        public string  $title,
        public string  $content,
        public string  $author_name,
        public array   $image_name,
        public array   $image_tmp_name,
        public ?array  $tag_id,
        public ?string $thumbnail_check
    )
    {
    }
}
