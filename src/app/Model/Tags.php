<?php

namespace App\Model;

class Tags
{
    public function __construct(
        public int $tag_id,
        public string $tagname
    )
    {
    }
}