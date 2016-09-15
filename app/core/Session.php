<?php

class Session
{
	/**
	* Handle put session
	*
	* @param $name string
	* @param $value string
	*/
	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

	/**
	* Handle get session
	*
	* @param $name string
	* @return string
	*/
	public static function get($name)
	{
		return $_SESSION[$name];
	} 

	/**
	* Handle delete session value
	*
	* @param $name string
	* @return unset
	*/
	public static function delete($name)
	{
		if(self::exists($name)){
			unset($_SESSION[$name]);
		}
	}

	/**
	* Handle check session value
	*
	* @param $name string
	* @return bool true | false
	*/
	public static function exists($name)
	{
		return (isset($_SESSION[$name])) ? true : false;
	}

	/**
	* Handle show session with value
	*
	* @param $name string
	* @param $message string
	* @return string
	*/
	public static function flash($name, $message = '')
	{
		if(self::exists($name)){
			$session = self::get($name);
			self::delete($name);
			return $session;
		} else {
			self::put($name, $message);
		}
	}
}