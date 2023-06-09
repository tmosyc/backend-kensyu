<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\GetPostDetailRepository;

class GetPostDetailService
{
    /**
     * @return array
     */
    public static function getPostArticleDetail($id)
    {
        return GetPostDetailRepository::selectArticleDetail($id);
    }
}
