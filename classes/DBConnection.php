<?php

namespace lesson\classes;

class DBConnection extends  PDOConfig
{	
	public function __construct()
	{
		try{
			parent::__construct();
			$this->query("SET NAMES utf8");
		} catch(\PDOException $error){
			throw new MyExeption("Ошибка базы данных");
			die;
		}
	}
}