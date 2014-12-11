<?
require_once __DIR__ . '/models/news.php';

if(isset($_GET["id"])){
	$id = (int) $_GET["id"];
	$news = get_news($_GET["id"]);
}
?>

<?if(isset($_GET["id"])):?>
<html>
<head>
    <title>Новость</title>
</head>
<body>
	<article>
		<h1><?=$news['title'];?></h1>
		<div><?=$news['text'];?></div>
	</article>
</body>
</html>
<?endif?>