<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19.11.18
 * Time: 9:32
 */



function connectDb(){
  $db = new PDO('mysql:host=localhost;dbname=blog', 'admin', '123456');

  return $db;

}

function isAuth(){
  if (!(isset($_SESSION['auth']) AND $_SESSION['auth'])){
    if (!(isset($_COOKIE['login']) AND isset($_COOKIE['pass']) AND $_COOKIE['login'] === 'admin' AND $_COOKIE['pass'] === md5('123456'))){
      return false;
    }
    $_SESSION['auth'] = true;
  }
  return true;
}

//index.php
function getAllArticles($db){
  $query = "SELECT id, title FROM articles";
  $stmt = $db->prepare($query);
  $stmt->execute();
  $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $res;
}

//add.php
function addArticle($db, $title, $text){
  $query = "INSERT INTO articles (title, text) VALUES (?, ?)";
  $stmt = $db->prepare($query);
  $stmt->execute([$title , $text]);
  $res = $db->lastInsertId();
  return $res;
}

//article.php

function getArticle($db, $id){
  $query = "SELECT * FROM articles WHERE id=?";
  $stmt = $db->prepare($query);
  $stmt->execute([$id]);
  $res = $stmt->fetch(PDO::FETCH_ASSOC);
  return $res;
}

//edit.php
/**
 * @param $db
 * @param $id
 * @param $title
 * @param $text
 * @return mixed bool if article was added to db return true, if not return false;
 */
function editArticle($db, $id, $title, $text){
  $query = "UPDATE articles SET title=?, text=? WHERE id=?";
  $stmt = $db->prepare($query);
  $res = $stmt->execute([$title, $text, $id]);
  return $res;
}