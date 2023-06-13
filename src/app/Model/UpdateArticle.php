<?php
namespace App\Model;
class UpdateArticle
{
    /**
     * @param int $id
     * @param string $title
     * @param string $content
     */
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
    )
    {
    }
}