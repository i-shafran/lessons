<?php

namespace lesson\classes;

class View extends Storage
{		
	// Возвращает вид
	public function display($template)
	{
		$this->template_name = $template;
				
		foreach($this as $key => $value)
		{
			${$key} = $value;
		}
		
		ob_start();
		header('Content-type: text/html; charset=UTF-8');
		require $_SERVER["DOCUMENT_ROOT"].$template;
		$res = ob_get_contents();
		ob_end_clean();
		
		return $res;
	}
}