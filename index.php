<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();
require_once 'functions.php';

if (isAuth()) {
  ?>
    <p><a href="account.php">To the private account</a></p>

  <?php
} else {
  ?>
    <p><a href="auth.php">Authorization</a></p>
  <?
}
echo '<hr>';

$db = connectDb();
$articles = getAllArticles($db);

foreach ($articles as $item) {
  echo "<p><a href='article.php?fname={$item['title']}'>{$item['title']}</a>";
  if (isAuth()) {
    echo '<a href="edit.php?fname=' . $item['title'] . '" class="del">Edit</a>';
    echo '<a href="delete.php?fname=' . $item['title'] . '">Delete</a>';
  }
}

echo '<hr>';
if (isAuth()) {
  echo '<p><a href="add.php">Add new article</a></p>';

}

