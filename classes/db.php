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
		parent::__construct();
		$this->query("SET NAMES utf8");
	}
	
	public function DBQuery($sql)
	{
		$res = $this->query($sql, PDO::FETCH_ASSOC);
		if(!$res){
			var_dump($this->errorInfo());
			return false;
		}
		$res = $res->fetchAll();

		return $res;
	}
	
	public function DBQueryOne($sql)
	{
		$res = $this->query($sql, PDO::FETCH_ASSOC);
		if(!$res){
			var_dump($this->errorInfo());
			return false;
		}
		$res = $res->fetch();

		return $res;
	}
}