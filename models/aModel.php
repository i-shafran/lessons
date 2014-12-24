<?php

abstract class AModel
{
	static protected $table;
	
	// Выбрать все
	static public function FindAll()
	{
		$DB = new DB();
		$sth = $DB->prepare("SELECT * FROM ".static::$table);
		$res = $sth->execute();

		if(!$res){
			$arError = $sth->errorInfo();
			throw new MyExeption($arError[2]);
		}

		$result = $sth->fetchAll();

		if(count($result) < 1){
			throw new MyExeption("Нечего показать");
		}

		return $result;
	}

	// Выбрать одну
	static public function FindOne($id)
	{
		$DB = new DB();
		$sth = $DB->prepare("SELECT * FROM ". static::$table ." WHERE id=:id");
		$sth->execute(array(
			':id' => $id
		));

		$result = $sth->fetch();

		return $result;
	}

	abstract public function save();
}