<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use App\Model\Article;
use PDO;

class PostArticleRepository
{
    public static function insertArticle(Article $article, PDO $pdo = null): void
    {
        if (is_null($pdo)) {
            $pdo = DbConnect::dbConnect();
        }
        $stmt = $pdo->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,1) RETURNING article_id");
        $params = array(':title' => $article->title, ':content' => $article->content);
        $stmt->execute($params);
        $article_id = $stmt->fetch(PDO::FETCH_ASSOC)['article_id'];
        $i=0;
        var_dump($article->image_array);
        if (isset($article->image_array)){
            mkdir(dirname(__DIR__,2)."/images/{$article_id}/",0777);
        }
        foreach ($article->image_array['tmp_name'] as $tmp_name){
            $img_name = "{$i}.jpg";
            move_uploaded_file($tmp_name, dirname(__DIR__,2)."/images/{$article_id}/" . $img_name);
            $stmt = $pdo->prepare("INSERT INTO image(article_id, resource_id) VALUES (:article_id,:index)");
            $params = array(':article_id' => $article_id, ':index' => $i);
            $stmt->execute($params);
            $i = $i+1;
        }

        $pdo = null;
    }
}
