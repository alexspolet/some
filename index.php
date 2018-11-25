<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();

$auth = isAuth();

require_once 'model/system_m.php';
require_once 'model/articles_m.php';
require_once 'model/global_vars.php';


$auth = isAuth();
$db = connectDb();
$articles = getAllArticles($db);

$path = getPath();
$content = renderHtml($path, [
    'auth' => $auth,
    'articles' => $articles,
]);

$html = renderHtml($main_vPath, [
    'content' => $content,
    'title' => 'Main page'
]);

echo $html;
