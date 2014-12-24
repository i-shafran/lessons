<?php
require_once __DIR__ . '/boot.php';

$news = new NewsModel();
$news->title = "Новый заголовок 2";
//$news->text = "Тестовый текст";
$news->id = 6;
$news->save();
die;


// http://index.php?page=/news/index

$route = $_GET["page"];
$routeParts = explode("/", $route);
$controllerClassName = ucfirst($routeParts[0]."Controller");
$actionName = $routeParts[1];


$controller = new $controllerClassName();
$controller->action($actionName);