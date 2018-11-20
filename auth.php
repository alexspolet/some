<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18.11.18
 * Time: 11:30
 */
session_start();
require_once 'functions.php';

$accountFile = './account.php';
$error = '';

if (isAuth()){
  header("location: $accountFile");
  exit();
}
$login = '';
$pass = '';
$setCookie = '';

if (!empty($_POST)){
  $login = filter_input(INPUT_POST , 'login' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $pass = filter_input(INPUT_POST , 'pass' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if (isset ($_POST['setCookie']) /*AND $_POST['setCookie'] !== ''*/){
    $setCookie = 'checked="checked"';
  }

  if ($login === 'admin' AND md5($pass) === md5('123456')){
    $_SESSION['auth'] = true;
    $_SESSION['pass'] = md5($pass);
    if ($setCookie){
      setcookie('login' , $login  , time() + 3600 * 24);
      setcookie('pass'  , md5($pass)  , time() + 3600 * 24);
    }
    header("location: $accountFile");
    exit();
  }else{
   $error = 'Invalid error or password';
  }
}
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <p>Enter login<input type="text" name="login" value="<?=$login?>"></p>
  <p>Enter password<input type="password" name="pass" value="<?=$pass?>"></p>
  <p>Remember me <input type="checkbox" name="setCookie" <?=$setCookie?>></p>
  <input type="submit" value="go">
</form>
<?if($error):?>
<p><?=$error?></p>
<?endif;?>
