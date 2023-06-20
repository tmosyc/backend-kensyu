<?php
declare(strict_types=1);

namespace App\Model;
class Article
{
    /**
     * @param string $title
     * @param string $content
     */
    public function __construct(
        public string $title,
        public string $content,
        public array $image_name,
        public array $image_tmp_name

    )
    {
    }
}
