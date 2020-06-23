<?php

// Отображение ошибок
ini_set('display_errors',1);
error_reporting(E_ALL);
////

session_start();

define('ROOT',dirname(__FILE__)); // Определяем контстанту для поиска по полному пути на диске
require_once (ROOT.'/components/Router.php'); // Подключаем файл Роутера
require_once (ROOT.'/components/DB.php'); // Подключаем Бд

$router = new Router();
$router -> run();

