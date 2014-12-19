<?php

class NewsModel extends Article
{
	private $DB;
	
	public function __construct()
	{
		$this->DB = new DB();
	}

	// Список новостей
	public function News_getAll()
	{
		$sql = "SELECT * FROM news";
		$res = $this->DB->DBQuery($sql);

		if(!$res){
			var_dump($this->DB->errorInfo());
			return false;
		}

		return $res;
	}
	
	// Получить 1 новость
	public function get_one_news($id)
	{
		$sql = "SELECT * FROM news WHERE id = $id";
		$res = $this->DB->DBQueryOne($sql);
		
		if(!$res){
			var_dump($this->DB->errorInfo());
			return false;
		}	
		
		return $res;		
	}
	
	// Добавить новость
	public function add_news($title, $text)
	{
		$sql = "INSERT INTO news (title, text) VALUES ('$title', '$text')";
		$res = $this->DB->query($sql);
		
		if($res){
			return true;
		} else {
			var_dump($this->DB->errorInfo());
			return false;
		}
	}
	
	// Обновить новость
	public function update_news($id)
	{
		
	}
}