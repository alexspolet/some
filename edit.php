<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 22:06
 */
session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';
require_once 'model/global_vars.php';

$auth = isAuth();
if (!$auth){
  header('location: auth.php');
  exit();
}


$errors = [];

if (!isset($_GET['aid']) OR $_GET['aid'] == ''){
  header("location: $mainfile");
}

$id = $_GET['aid'];

$db = connectDb();
$article = getArticle($db, $id);

if (!$article){
  $errors = 'Article not found';
}else{
  $title = $article['title'];
  $text = $article['text'];

  if (!empty($_POST)) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if ($title === '' OR $text === '') {
      $errors[] = 'All fields must be full';
    }

    if ($errors) {
      foreach ($errors as $error) {
        echo "<p>$error</p>";
      }
    } else {
      $res = editArticle($db, $id, $title, $text);
      if ($res){
        header("location: article.php?aid=$id");
        exit();
      }else{
          echo '<p>Error. Cannot edit the article</p>';
      }

    }
  }

  ?>

<?

}