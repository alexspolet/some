<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 12:03
 */

session_start();
require_once 'functions.php';

if (!isAuth()){
  header('location: index.php');
  exit();
}
$dir = './articles';
$fname = trim(filter_input(INPUT_GET, 'fname' , FILTER_SANITIZE_STRING));
$path =  $dir . '/' . $fname;
if (!(isset($fname) AND $fname != '' AND file_exists($path))){
  echo 'oooops. This file is not exists <br><a href="index.php">To the main page</a>';
  exit();
}
unlink($path);
