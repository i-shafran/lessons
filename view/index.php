<html>
<head>
    <title>Новости</title>
</head>
<body>
<p>Шаблон <?=$this->template_name?></p>
    <?php foreach ($this->arData as $article): ?>
    <article>
        <h1><?=$article['title'];?></h1>
        <div><?=$article['text'];?></div>
    </article>
    <?php endforeach; ?>
</body>
</html>

<?var_dump($this)?>