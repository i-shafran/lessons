<?php

namespace lesson\controllers;

class NewsController extends AController
{	
	// Список новостей
	protected function actionIndex()
	{
		$this->view->arData = $this->model->FindAll();
		
		echo $this->view->display("/view/index.php");
	}
	
	// Детальная новости
	protected function actionDetail()
	{
		if(isset($_GET["id"])){
			$id = (int) $_GET["id"];
		} else {
			return false;
		}

		$this->view->arData = $this->model->FindOne($id);

		if(!$this->view->arData){
			echo "Что-то пошло не так или такой новости нет";
		} else {
			echo $this->view->display("/view/news_detail.php");
		}
		
		return true;
	}
}