<?php

class PDOConfig extends PDO {

	private $engine;
	private $host;
	private $database;
	private $user;
	private $pass;

	public function __construct(){
		$config = config();
		$this->engine = 'mysql';
		$this->host = $config['db']['host'];
		$this->database = $config['db']['dbname'];
		$this->user = $config['db']['user'];
		$this->pass = $config['db']['password'];
		$dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
		var_dump($dns);
		parent::__construct( $dns, $this->user, $this->pass );
	}
}

function config()
{
    return include __DIR__ . '/../config.php';
}

$DB = new PDOConfig();




function DBConnect()
{
    $config = config();
    mysql_connect(
        $config['db']['host'],
        $config['db']['user'],
        $config['db']['password']
    );
    mysql_select_db($config['db']['dbname']);
}

function DBQuery($sql)
{
	global $DB;
	$res = array();
	$DB->query("SET NAMES utf8");
	$res = $DB->query($sql, PDO::FETCH_ASSOC);
	$res = $res->fetchAll();
	
	return $res;
	
	
/*    DBConnect();
    $res = mysql_query($sql);
    if (!$res) {
        echo mysql_error();
        return [];
    }

    $ret = [];
    while ($row = mysql_fetch_assoc($res))
    {
        $ret[] = $row;
    }
    return $ret;*/
}