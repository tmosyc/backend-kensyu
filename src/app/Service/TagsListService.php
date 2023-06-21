<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\PickTagsRepository;

class TagsListService
{
    public static function tagList()
    {
        return PickTagsRepository::selectTags();
    }
}