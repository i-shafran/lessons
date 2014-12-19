<?php

require_once __DIR__ . '/../controllers/newsController.php';

$news = new NewsController();

$news->CAdd_news();