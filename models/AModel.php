<?php

namespace lesson\models;

use lesson\classes\DBConnection;
use lesson\classes\MyExeption;

abstract class AModel
{
	static protected $table;
	static protected $columns;
	
	// Выбрать все
	static public function FindAll()
	{
		$DB = new DBConnection();
		$sth = $DB->prepare("SELECT * FROM ".static::$table);
		$sth->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
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
		$DB = new DBConnection();
		$sth = $DB->prepare("SELECT * FROM ". static::$table ." WHERE id=:id");
		$sth->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
		$sth->execute(array(
			':id' => $id
		));

		$result = $sth->fetch();

		return $result;
	}

	// Сохранение и обновление новости
	public function save()
	{
		$tokens = implode(",", static::$columns);
		$values = ":".implode(",:", static::$columns);
		$arUpdate = array();
		$arInsert = array();
		$DB = new DBConnection();

		foreach(static::$columns as $value){
			if(isset($this->$value)){
				$arUpdate[] = "$value=:$value";
				$arInsert[":$value"] = $this->$value;
			}
		}
		
		// Если данных нет вообще
		if(empty($arUpdate)){
			throw new MyExeption("Нет данных");
		}

		if(!isset($this->id)){
			$sql = "INSERT INTO ". static::$table . " ($tokens) VALUES ($values)";
			$sth = $DB->prepare($sql);
			$sth->execute($arInsert);
			$this->id = $DB->lastInsertId();
		} else {
			$sql = "
				UPDATE ". static::$table ."
				SET ". implode(', ', $arUpdate) ."
				WHERE id=:id
			";
			$sth = $DB->prepare($sql);
			$sth->execute(array(':id' => $this->id) + $arInsert);
		}
	}
	
	// Удаление записи
	public function delete()
	{
		if(!isset($this->id)){
			throw new MyExeption("Нечего удалять");
		}

		$DB = new DBConnection();
		
		// Проверка наличия в базе
		$sql = "SELECT id FROM ". static::$table ." WHERE id=:id";
		$sth = $DB->prepare($sql);
		$sth->execute(array(":id" => $this->id));

		$res = $sth->fetchObject();
			
		if(!$res){
			throw new MyExeption("Записи с таким id не найдено");
		}
		
		// Удаление
		$sql = "DELETE FROM ". static::$table ." WHERE id=:id";
		$sth = $DB->prepare($sql);
		$sth->execute(array(":id" => $this->id));
	}
}