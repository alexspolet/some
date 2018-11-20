<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 12:03
 */

session_start();
require_once 'functions.php';

if (!isAuth()){
  header('location: index.php');
  exit();
}
$mainfile = 'index.php';
$id = $_GET['aid'];

$db = connectDb();
$article = getArticle($db, $id);

if (!$article){
  $error = 'Article not found';
}else{
  $res = deleteArticle($db, $article['id']);
  if (!$res){
    $error = 'Cannot delete this article';
  }
}

require_once 'view/delete_v.php';


