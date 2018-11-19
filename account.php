<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.18
 * Time: 12:19
 */

session_start();
require_once 'functions.php';


if (isAuth()){
  echo "<p>Hello admin. You authorized successfully</p>";
  echo "<p><a href='index.php'>To the main page</a></p>";
} else {
  header('location: auth.php');
  exit();
}

if (!empty($_POST) AND isset($_POST['exit'])){
  $_SESSION['auth'] = false;

  setcookie('login' , 'admin' , time()-1); /*unset ($_COOKIE['login']);*/
  setcookie('pass' , md5('123456') , time()-1); /*unset ($_COOKIE['pass']);*/

  header('location: index.php');
  exit();
}
?>



<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <input type="submit" value="exit" name="exit">
</form>
<?
