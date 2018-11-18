<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.18
 * Time: 12:19
 */

session_start();

if ((isset($_SESSION['auth']) AND $_SESSION['auth']) OR (isset($_COOKIE['login']) AND $_COOKIE['login'] === 'admin' AND isset($_COOKIE['pass']) AND $_COOKIE['pass'] === md5('123456'))){
  echo "<p>Hello admin. You authorized successfully</p>";
  echo "<p><a href='index.php'>To the main page</a></p>";
} else {
  header('location: auth.php');;
}

if (!empty($_POST)){

  $_SESSION['auth'] = false;

  setcookie('login' , 'admin' , time()-1); /*unset ($_COOKIE['login']);*/
  setcookie('pass' , md5('123456') , time()-1); /*unset ($_COOKIE['pass']);*/

  header('location: index.php');

}
?>



<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <input type="submit" value="exit" name="exit">
</form>
<?
