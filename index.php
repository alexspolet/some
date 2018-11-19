<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();
require_once 'functions.php';

$dir = './articles';
$files = scandir($dir);

if (isAuth()){
?>

<p><a href="account.php">To the private account</a></p>

<?php
  }else{
  ?>
  <p><a href="auth.php">Authorization</a></p>
  <?
}
echo '<hr>';
foreach ($files as $file){
  if (is_file($dir . '/' .$file)) {
    echo "<p><a href='article.php?fname=$file'>$file</a></p>";
  }
}
echo '<hr>';
if ((isset($_SESSION['auth']) AND $_SESSION['auth']) OR ( isset($_COOKIE['login']) AND $_COOKIE['login'] === 'admin' AND isset($_COOKIE['pass']) AND $_COOKIE['pass'] === md5('123456'))){
  echo '<p><a href="add.php">Add new article</a></p>';

}

