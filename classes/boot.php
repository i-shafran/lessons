<?php

function __autoload($class)
{
	$arClassDirs = array("classes", "controllers", "models");
	foreach($arClassDirs as $folder)
	{
		$classPath = __DIR__ . "/../$folder/$class.php";
		
		if(is_file($classPath))
		{
			require $classPath;
			break;
		}
	}
}