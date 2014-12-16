<?php
require_once __DIR__ . '/../classes/storage.php';

class View extends Storage
{
	const view_patch = "/view/";
	
	public $template_name = "";
	
	public  function __construct()
	{
		
	}
	
	// Возвращает вид
	public function display($template)
	{
		$this->template_name = $template;
		
		//var_dump($this->arData);		
		
		ob_start();
		header('Content-type: text/html; charset=UTF-8');
		include $_SERVER["DOCUMENT_ROOT"].self::view_patch.$template.".php";
		$res = ob_get_contents();
		ob_end_clean();
		
		return $res;
	}
}