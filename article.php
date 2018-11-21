<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:49
 */
session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';


$mainfile = 'index.php';
$id = $_GET['aid'];
$db = connectDb();
$article = getArticle($db, $id);
if (!$article) {
  header("location:$mainfile");
}
require_once 'view/article_v.php';

