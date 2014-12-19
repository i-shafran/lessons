<?php
require_once __DIR__ . '/classes/boot.php';

$news = new NewsController();

$news->index();