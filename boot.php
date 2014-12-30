<?php
include __DIR__ . '/vendor/autoload.php';

function __autoload($class)
{
	$namespace = explode("\\", $class);
	array_shift($namespace);
	if(isset($namespace[0]) and isset($namespace[1])){
		$classPath = __DIR__ . "/$namespace[0]/$namespace[1].php";
		
		if(is_readable($classPath))
		{
			require $classPath;
			
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}