<?php

class NewsModel extends AModel
{
	static protected $table = "news";
	
	static protected $columns = array("title", "text");
	
}