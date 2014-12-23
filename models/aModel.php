<?php

abstract class AModel
{
	static public $sql = array(
		"QueryAll" => "SELECT * FROM {table}",
		"QueryOne" => "SELECT * FROM {table} WHERE id=:id",
		"AddRow" => "INSERT INTO {table} (title, text) VALUES (:title, :text)"
	);

	static protected $table;

	protected $DB;

	public function __construct()
	{
		$this->DB = new DB();
		static::set_sql();
	}
	
	static protected function set_sql()
	{
		foreach(static::$sql as &$sql)
		{
			$sql = str_replace("{table}", static::$table, $sql);
		}
		unset($sql);
	}

	// Выбрать все
	public function QueryAll()
	{
		try{
			$sth = $this->DB->prepare(static::$sql["QueryAll"]);
			$res = $sth->execute();

			if(!$res){
				$arError = $sth->errorInfo();
				throw new MyExeption($arError[2]);
			}

			$result = $sth->fetchAll();

			if(count($result) < 1){
				throw new MyExeption("Нечего показать");
			}
		} catch (MyExeption $error){
			echo $error->getMessage();
			die;
		}

		return $result;
	}

	// Выбрать одну
	public function QueryOne($id)
	{
		try{
			$sth = $this->DB->prepare(static::$sql["QueryOne"]);
			$sth->execute(array(
				':id' => $id
			));
	
			$result = $sth->fetch();
		} catch (MyExeption $error){
			echo $error->getMessage();
			die;
		}

		return $result;
	}

	abstract public function getAll();
	abstract public function getOne($id);
	abstract public function add($title, $text);
	abstract public function update($id);
}