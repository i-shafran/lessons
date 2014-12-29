<?php

namespace lesson\controllers;

use lesson\models\NewsModel as NewsModel;
use lesson\classes\View as View;

abstract class AController
{
	protected $model;

	protected $view;

	public function __construct()
	{
		$this->model = new NewsModel();
		$this->view = new View();
	}

	public function action($name)
	{
		$actionName = 'action'.ucfirst($name);
		if(method_exists($this, $actionName)){
			$this->$actionName();
		}
	}
}