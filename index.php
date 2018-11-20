<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.11.18
 * Time: 17:36
 */
session_start();
require_once 'functions.php';

$db = connectDb();
$articles = getAllArticles($db);

require_once 'view/index_v.php';
