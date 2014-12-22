<?php

class NewsController extends AController
{
	private $model;
		
	private $view;
	
	public function __construct()
	{
		$this->model = new NewsModel();
		$this->view = new View();
	}
	
	// Список новостей
	protected function actionIndex()
	{
		$this->view->arData = $this->model->News_getAll();
		
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

		$this->view->arData = $this->model->get_one_news($id);

		if(!$this->view->arData){
			echo "Что-то пошло не так или такой новости нет";
		} else {
			echo $this->view->display("/view/news_detail.php");
		}
		
		return true;
	}
	
	// Форма добавления новости
	protected function actionAdd_form()
	{
		echo $this->view->display("/view/add_news.php");
		return true;
	}
	
	// Добавление новости
	protected function actionAdd()
	{
		if(isset($_POST["title"]) and isset($_POST["text"]))
		{
			$_POST["title"] = strip_tags($_POST["title"]);
			$_POST["text"] = strip_tags($_POST["text"]);

			$res = $this->model->add_news($_POST["title"], $_POST["text"]);

			if(!$res){
				echo "Что-то пошло не так";
			} else {
				$this->view->MESS = "Новость успешно добавлена!";
				echo $this->view->display("/view/add_news.php");
			}
			
			return true;
		} else {
			return false;
		}		
	}
	
	// Обновление новости
	protected function actionUpdate()
	{
		if(isset($_GET["id"])){
			$id = (int) $_GET["id"];
		} else {
			return false;
		}

		$this->view->arData = $this->model->get_one_news($id);

		if(!$this->view->arData){
			echo "Нет такой новости";
		} else {
			echo $this->view->display("/view/update_news.php");
		}
		
		return true;
	}
}