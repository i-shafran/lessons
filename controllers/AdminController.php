<?php

class NewsController extends AController
{
	// Форма добавления новости
	protected function actionAddForm()
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

			$this->model->title = $_POST["title"];
			$this->model->text = $_POST["text"];
			$this->model->save();

			echo $this->view->display("/view/add_news.php");
			

			return true;
		} else {
			return false;
		}
	}

	// форма обновления новости
	protected function actionUpdateForm()
	{
		if(isset($_GET["id"])){
			$id = (int) $_GET["id"];
		} else {
			return false;
		}

		$this->view->arData = $this->model->FindOne($id);

		if(!$this->view->arData){
			echo "Нет такой новости";
		} else {
			echo $this->view->display("/view/update_news.php");
		}

		return true;
	}
	
	// Обновление новости
	protected function actionUpdate()
	{
		if(isset($_GET["id"])){
			$id = (int) $_GET["id"];
		} else {
			return false;
		}

		if(isset($_GET["title"])){
			$_POST["title"] = strip_tags($_POST["title"]);
			$this->model->title = $_POST["title"];
		}

		if(isset($_GET["text"])){
			$_POST["text"] = strip_tags($_POST["text"]);
			$this->model->text = $_POST["text"];			
		}

		$this->model->save();
		
		$this->view->MESS = "Новость успешно обновлена";
		echo $this->view->display("/view/add_news.php");
		
		return true;
	}
}