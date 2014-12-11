<?

abstract class Article
{
	abstract public function News_getAll();
	abstract public function get_one_news($id);
	abstract public function add_news($title, $text);
	abstract public function update_news($id);
}