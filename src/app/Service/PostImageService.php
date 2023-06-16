<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\PostImageRepository;

class PostImageService
{
    public static function PostImageList($image_array)
    {
        return PostImageRepository::postInsertImage($image_array);
    }
}
