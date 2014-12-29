<?php

function __autoload($class)
{
	$namespace = explode("\\", $class);
	array_shift($namespace);
	$classPath = __DIR__ . "/$namespace[0]/$namespace[1].php";
	
	if(is_readable($classPath))
	{
		require $classPath;
		
		return true;
	} else {
		return false;
	}
}