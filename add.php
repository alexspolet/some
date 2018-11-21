<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:51
 */
session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';


if (!isAuth()) {
  header('location: auth.php');
  exit();
}

$mainfile = 'index.php';

$title = '';
$text = '';
$errors = [];

if (!empty($_POST)) {

  $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  //$path = $dir . '/' . $title;


  if ($title === '' OR $text === '') {
    $errors[] = 'All fields must be full';
  }
  $db = connectDb();

  /*if (file_exists($path)) {
    $errors[] = 'File with this name already exists. Choose another title';
  }*/

  $articles = getAllArticles($db);
  foreach ($articles as $article) {
    if ($title === $article['title']) {
      $errors[] = 'An article with such name already exists';
    }
  }

  if ($errors) {
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  } else {


    $res = addArticle($db, $title, $text);
    if (!$res) {
      echo '<p>Error. We cannot add article to the db</p>';
    }

    header("location: $mainfile");
    exit();
  }
}

require_once 'view/add_v.php';

