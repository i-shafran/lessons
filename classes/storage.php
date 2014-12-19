<?php

class Storage implements Countable, Iterator
{
	private $data = array();
	
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
			return null;
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
		return next($this->data);
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
		if(key($this->data) !== NULL){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Rewind the Iterator to the first element
	 * @return void Any returned value is ignored.
	 */
	public function rewind()
	{
		return reset($this->data);
	}
}