<? header('Content-type: text/html; charset=UTF-8');?>
<form action="" method="post" enctype="application/x-www-form-urlencoded">
	<label for="title">Название новости</label><br>
	<input id="title" type="text" name="title"><br>
	<label for="text">Текст новости</label><br>
	<input id="text" name="text" type="text"><br>
	<input type="submit" name="submit" value="Добавить новость">
</form>

<?if(isset($_POST["submit"])){
	require_once __DIR__ . '/../models/news.php';

	add_news($_POST);
}?>