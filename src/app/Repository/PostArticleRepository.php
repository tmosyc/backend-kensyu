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
            $article_insert = $pdo->prepare("INSERT INTO article(user_id,title,text,thumbnail_image_id) VALUES (1, :title,:content,1) RETURNING article_id");
            $params = array(':title' => $article->title, ':content' => $article->content);
            $article_insert->execute($params);
            $article_id = $article_insert->fetch(PDO::FETCH_ASSOC)['article_id'];
            $i=0;

            // image_array = $_FILE['image']
            if (isset($article->image_array)){
                mkdir(dirname(__DIR__,2)."/images/article/{$article_id}/",0777);
            }
            foreach ($article->image_array['tmp_name'] as $tmp_name){
                if (strpos($article->image_array['name'][$i], 'jpg')){
                    $img_name = "{$i}.jpg";
                }
                if (strpos($article->image_array['name'][$i], 'png')) {
                    $img_name = "{$i}.png";
                }
                move_uploaded_file($tmp_name, dirname(__DIR__,2)."/images/article/{$article_id}/" . $img_name);
                $image_insert = $pdo->prepare("INSERT INTO image(article_id, resource_id) VALUES (:article_id,:index)");
                $params = array(':article_id' => $article_id, ':index' => $i);
                $image_insert->execute($params);
                $i = $i+1;
            }
            if ($article_insert && $image_insert) {
                $pdo->commit();
            }
        } catch(PDOException $e) {
            $pdo->rollBack();
        } finally {
            $pdo = null;
        }
    }
}
