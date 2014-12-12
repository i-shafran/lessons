<?
require_once __DIR__ . '/../models/news.php';

class NewsController
{
	private $model;
	
	public function __construct()
	{
		$this->model = new NewsModel();
	}
	
	// Список новостей
	public function index()
	{
		$arData = $this->model->News_getAll();
		header('Content-type: text/html; charset=UTF-8');
		return include_once __DIR__ . '/../view/index.php';
	}
	
	// Детальная новости
	public function CNews_detail()
	{
		if(isset($_GET["id"])){
			$id = (int) $_GET["id"];
		} else {
			return false;
		}
		
		$arData = $this->model->get_one_news($id);

		header('Content-type: text/html; charset=UTF-8');
		if(!$arData){
			return "Что-то пошло не так или такой новости нет";
		} else {
			return include_once __DIR__ . '/../view/news_detail.php';
		}
	}
	
	// Добавление новости
	public function CAdd_news()
	{
		if(!isset($_POST["title"]) or !isset($_POST["text"]))
		{
			header('Content-type: text/html; charset=UTF-8');
			return include_once __DIR__ . '/../view/add_news.php';
		} else {
			foreach($_POST as &$value)
			{
				$value = strip_tags($value);
			}
			unset($value);

			$res = $this->model->add_news($_POST["title"], $_POST["text"]);

			header('Content-type: text/html; charset=UTF-8');
			if(!$res){
				return "Что-то пошло не так";
			} else {
				$arData["MESS"] = "Новость успешно добавлена!";
				return include_once __DIR__ . '/../view/add_news.php';
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

		header('Content-type: text/html; charset=UTF-8');
		if(!isset($arData["title"])){
			echo "Нет такой новости";
		} else {
			return include_once __DIR__ . '/../view/update_news.php';
		}		
	}
}