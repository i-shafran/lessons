<?php

class Storage implements Countable, Iterator
{
	private $data = array();
	
	private $element = true;
	
	public function __construct()
	{
		
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		if(isset($this->data[$key])){
			return $this->data[$key];
		} else {
			return "Error";
		}
	}

	/**
	 * @return int The custom count as an integer.
	 * The return value is cast to an integer.
	 */
	public function count()
	{
		return count($this->data);
	}

	/**
	 * Return the current element
	 * @return mixed Can return any type.
	 */
	public function current()
	{
		return current($this->data);
	}

	/**
	 * Move forward to next element
	 * @return void Any returned value is ignored.
	 */
	public function next()
	{
		$res = next($this->data);
		if($res === false){
			$this->element = false;
		}
		
		return $res;
	}

	/**
	 * Return the key of the current element
	 * @return mixed scalar on success, or null on failure.
	 */
	public function key()
	{
		return key($this->data);
	}

	/**
	 * Checks if current position is valid
	 * @return boolean The return value will be casted to boolean and then evaluated.
	 * Returns true on success or false on failure.
	 */
	public function valid()
	{
		return $this->element;
	}

	/**
	 * Rewind the Iterator to the first element
	 * @return void Any returned value is ignored.
	 */
	public function rewind()
	{
		$res = reset($this->data);
		if($res === false)
		{
			$this->element = false;
		}
		
		return $res;
	}
}

$st = new Storage();

$st->foo = "dfsd";
$st->ddd = 458;
$st->dfd = "gfdg";

foreach($st as $key => $value)
{
	echo $key . "=" . $value;
	echo "<br>";
}