<?php

class PDOConfig extends PDO
{

	const config_file = "config.php";
	
	private $engine;
	private $host;
	private $database;
	private $user;
	private $pass;

	public function __construct(){
		$config = include __DIR__ . "/../".self::config_file;
		$this->engine = 'mysql';
		$this->host = $config['db']['host'];
		$this->database = $config['db']['dbname'];
		$this->user = $config['db']['user'];
		$this->pass = $config['db']['password'];
		$dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
		parent::__construct( $dns, $this->user, $this->pass );
	}
}

class DB extends  PDOConfig
{	
	public function __construct()
	{
		try{
			parent::__construct();
			$this->query("SET NAMES utf8");
		} catch(PDOException $error){
			throw new MyExeption("Ошибка базы данных");
			die;
		}
	}
}