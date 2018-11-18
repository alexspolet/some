<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:49
 */
session_start();

$mainfile = 'index.php';
$dir = './articles';
$print = false;
$title = '';

$fname =  trim(filter_input(INPUT_GET , 'fname' , FILTER_SANITIZE_ENCODED));

$path = $dir . '/' . $fname;

if (!file_exists($path) OR !is_file($path)){
  echo 'ooops. 404';
}else{
  $title = $fname;
  $text = file($path);
  $print = true;
}
?>
<?if($print):?>
<h1><?=$title?></h1>
<?foreach ($text as $paragraph):?>
<p><?=$paragraph?></p>
<?endforeach;?>
<?endif;?>
<?if ((isset($_SESSION['auth']) AND $_SESSION['auth']) OR ( isset($_COOKIE['login']) AND $_COOKIE['login'] === 'admin' AND isset($_COOKIE['pass']) AND $_COOKIE['pass'] === md5('123456'))):?>
<p><a href="edit.php?fname=<?=$title?>">Edit article</a></p>
<?endif;?>
<p><a href="<?=$mainfile?>">To the main page</a></p>
