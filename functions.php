<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 9:32
 */

function isAuth(){
  if (!(isset($_SESSION['auth']) AND $_SESSION['auth'])){
    echo __LINE__ . '<br>';
    if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND $_COOKIE['login'] === 'admin' AND $_COOKIE['pass'] === md5('123456'))){
      var_dump($_SESSION);
      var_dump($_COOKIE);
      echo __LINE__ . '<br>';
      return false;
    }
    echo __LINE__ . '<br>';
    $_SESSION['auth'] = true;
  }
  echo __LINE__ . '<br>';
  return true;
}