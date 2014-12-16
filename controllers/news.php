<?
require_once __DIR__ . '/../models/news.php';
require_once __DIR__ . '/../classes/view.php';

class NewsController
{
	private $model;
		
	private $view;
	
	public function __construct()
	{
		$this->model = new NewsModel();
		$this->view = new View();
	}
	
	// Список новостей
	public function index()
	{
		$this->view->arData = $this->model->News_getAll();
		
		echo $this->view->display("index");
	}
	
	// Детальная новости
	public function CNews_detail()
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
			echo $this->view->display("news_detail");
		}
		
		return true;
	}
	
	// Добавление новости
	public function CAdd_news()
	{
		if(!isset($_POST["title"]) or !isset($_POST["text"]))
		{
			echo $this->view->display("add_news");
		} else {
			foreach($_POST as &$value)
			{
				$value = strip_tags($value);
			}
			unset($value);

			$this->view->arData = $this->model->add_news($_POST["title"], $_POST["text"]);

			if(!$this->view->arData){
				echo "Что-то пошло не так";
			} else {
				$this->view->arData["MESS"] = "Новость успешно добавлена!";
				echo $this->view->display("add_news");
			}
		}		
	}
	
	// Обновление новости
	public function CUpdate_news()
	{
		if(isset($_GET["id"])){
			$id = (int) $_GET["id"];
		} else {
			return false;
		}

		$arData = $this->model->get_one_news($id);

		if(!isset($arData["title"])){
			echo "Нет такой новости";
		} else {
			echo $this->view->display("update_news");
		}
		
		return true;
	}
}