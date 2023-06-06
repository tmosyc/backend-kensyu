<?php

require_once __DIR__ . '/vendor/autoload.php';
$app = new App\App();
$app->run();
// $db = new PDO('pgsql:dbname=db;host=db','root', 'root');
// if($db->connect_error) {
//     echo '接続失敗'.PHP_EOL;
//     exit();
// } else {
//     echo '接続成功'.PHP_EOL;
// }
