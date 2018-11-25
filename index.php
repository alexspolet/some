<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();
require_once 'model/system_m.php';
require_once 'model/articles_m.php';

$auth = isAuth();
$db = connectDb();
$articles = getAllArticles($db);

require_once 'view/index_v.php';
