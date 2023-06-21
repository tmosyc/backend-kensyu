<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use PDO;
use App\Model\Tags;

class PickTagsRepository
{
    public static function selectTags($pdo = null)
    {
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }

        $select_tags = $pdo -> prepare("SELECT tag_id, tagname FROM tag");
        $select_tags ->execute();
        $tags = [];
        while ($row = $select_tags->fetch(PDO::FETCH_ASSOC)) {
            $tag = new Tags(
                tag_id: $row['tag_id'],
                tagname:$row['tagname']
            );
            $tags[] = $tag;

        }
        return $tags;
    }
}
