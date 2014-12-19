<h1>Редактирование новости</h1>
<form action="" method="post" enctype="application/x-www-form-urlencoded">
	<label for="title">Название новости</label><br>
	<input id="title" type="text" name="title" value="<?=$arData["title"]?>"><br>
	<label for="text">Текст новости</label><br>
	<input id="text" name="text" type="text" value="<?=$arData["text"]?>"><br>
	<input type="submit" name="submit" value="Изменить новость">
</form>

<?if(isset($arData["MESS"])){
	echo "<p>$arData[MESS]</p>";
}?>