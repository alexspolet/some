<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 9:32
 */

function isAuth(){
  if (!(isset($_SESSION['auth']) AND $_SESSION['auth'])){
    if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND $_COOKIE['login'] === 'admin' AND $_COOKIE['pass'] === md5('123456'))){
      return false;
    }
    $_SESSION['auth'] = true;
  }
  return true;
}