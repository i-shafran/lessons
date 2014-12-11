<?php

require_once __DIR__ . '/controllers/news.php';

$news = new NewsController();

echo $news->index();