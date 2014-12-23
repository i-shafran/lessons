<?php

class NewsModel extends AModel
{
	static protected $table = "news";
	
	// Список новостей
	public function getAll()
	{
		return $this->QueryAll();
	}
	
	// Получить 1 новость
	public function getOne($id)
	{
		return $this->QueryOne($id);
	}
	
	// Добавить новость
	public function add($title, $text)
	{
		$sth = $this->DB->prepare(static::$sql["AddRow"]);
		$res = $sth->execute(array(
			':title' => $title,
			':text' => $text
		));

		if($res){
			return true;
		} else {
			var_dump($this->DB->errorInfo());
			return false;
		}
	}
	
	// Обновить новость
	public function update($id)
	{
		
	}
}