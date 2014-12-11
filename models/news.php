<?php

require_once __DIR__ . '/../functions/db.php';

function News_getAll()
{
    return DBQuery("
    SELECT * FROM news
    ");
}


function add_news($post)
{
	foreach($post as $key => &$value)
	{
		$value = strip_tags($value);
	}
	unset($value);
	
	global $DB;
	
	$sql = "INSERT INTO news (title, text) VALUES ('$post[title]', '$post[text]')";
	$DB->query($sql);
	var_dump($DB->errorInfo());
}

function get_news($id)
{
	global $DB;
	
	$sql = "SELECT * FROM news WHERE id = $id";
	$rrr = DBQuery($sql);
	var_dump($rrr);
	
	return $rrr;
	
}