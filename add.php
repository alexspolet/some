<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:51
 */
session_start();

if (!((isset($_SESSION['auth']) AND $_SESSION['auth']) OR ( isset($_COOKIE['login']) AND $_COOKIE['login'] === 'admin' AND isset($_COOKIE['pass']) AND $_COOKIE['pass'] === md5('123456')))){
    var_dump($_COOKIE);
    var_dump($_SESSION);
    die(__FILE__ . ' ' . __LINE__);
    header('location: auth.php');
}
$dir = './articles';
$mainfile = 'index.php';

$title = '';
$text = '';
$errors = [];

if (!empty($_POST)) {

  $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

  if (preg_match('/[\/\\\:*?|]/' ,$title )){
      $errors[] = 'Chars: /\:*?«| are forbidden in names of files';
  }

  $text = trim(filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
  $path = $dir . '/' . $title;

echo $title .  '<br>';
echo $text .  '<br>';
echo $fname .  '<br>';

  if ($title === '' OR $text === '') {
    $errors[] = 'All fields must be full';
  }
  if (file_exists($path)) {
    $errors[] = 'File with this name already exists. Choose another title';
  }

  if ($errors) {
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  }else{

      file_put_contents($path , $text);
      header("location: $mainfile");
  }
}

?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <p>Enter title <br><input type="text" value="<?= $title ?>" name="title"></p>
    <p>Enter text <br><textarea name="text" cols="50" rows="10"><?= $text ?></textarea></p>
    <input type="submit" value="save">
</form>

