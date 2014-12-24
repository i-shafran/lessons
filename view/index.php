<html>
<head>
    <title>Новости</title>
</head>
<body>
<p>Шаблон <?=$template_name;?></p>
    <?php foreach ($arData as $article): ?>
    <article>
        <h1><?=$article['title'];?></h1>
        <div><?=$article['text'];?></div>
    </article>
    <?php endforeach; ?>
</body>
</html>