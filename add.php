<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:51
 */
session_start();
require_once 'functions.php';

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

  if ($title === '' OR $text === '') {
    $errors[] = 'All fields must be full';
  }
  $db = connectDb();
  $articles = getAllArticles($db);

  foreach ($articles as $article) {
    if ($title === $article['title'] AND $title != '') {
      $errors[] = 'An article with such name already exists';
    }
  }

  $res = addArticle($db, $title, $text);
  if (!$res) {
    if (empty($errors)) {
      $errors[] = 'Cannot add article to the db';
    }
  }
}

require_once 'view/add_v.php';

