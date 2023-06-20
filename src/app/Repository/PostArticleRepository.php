<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\DbConnect;
use App\Model\Article;
use PDO;

class PostArticleRepository
{
    /**
     * @param Article $article
     * @param PDO|null $pdo
     * @return void
     */
    public static function insertArticle(Article $article, PDO $pdo = null): void
    {
        try {
            if (is_null($pdo)) {
                $pdo = DbConnect::dbConnect();
            }

            $pdo -> beginTransaction();

            $image_name_array = $article ->image_name;
            if (is_null($_POST['check'])) {
                $thumbnail_id = 'null';
            } else {
                $thumbnail_id = array_search($_POST['check'], $image_name_array);
            }

            $article_insert = $pdo->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,$thumbnail_id) RETURNING article_id");
            $params = array(':title' => $article->title, ':content' => $article->content);
            $article_insert->execute($params);
            $article_id = $article_insert->fetch(PDO::FETCH_ASSOC)['article_id'];
            $i=0;

            if (isset($article->image_name)){
                mkdir(dirname(__DIR__,2)."/images/article/{$article_id}/",0777);
            }

            foreach ($article->image_tmp_name as $tmp_name) {
                if (strpos($article->image_name[$i], 'jpg')) {
                    $img_name = "{$i}.jpg";
                }
                if (strpos($article->image_name[$i], 'png')) {
                    $img_name = "{$i}.png";
                }

                move_uploaded_file($tmp_name, dirname(__DIR__, 2) . "/images/article/{$article_id}/" . $img_name);
                $image_insert = $pdo->prepare("INSERT INTO image(article_id, resource_id) VALUES (:article_id, :index)");
                $params = array(':article_id' => $article_id, ':index' => $i);
                $image_insert->execute($params);
                $i = $i + 1;
            }

            foreach ($article->tag_id as $tag_id) {
                var_dump($tag_id);
                $tag_insert = $pdo->prepare("INSERT INTO article_tag (tag_id, article_id) VALUES (:tag_id,:article_id)");
                $params = array(':tag_id' => $tag_id, ':article_id' => $article_id);
                $tag_insert -> execute($params);
            }

            if ($article_insert && $image_insert && $tag_insert) {
                $pdo->commit();
            }
        } catch(PDOException $e) {
            $pdo->rollBack();
        } finally {
            $pdo = null;
        }
    }
}
