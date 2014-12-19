<?php
require_once __DIR__ . '/classes/boot.php';


// http://index.php?page=/news/index

$route = $_GET["page"];
$routeParts = explode("/", $route);
$controllerClassName = ucfirst($routeParts[0]."Controller");
$actionName = $routeParts[1];


$controller = new $controllerClassName();
$controller->action($actionName);