<?php

class Token
{
	/**
	*  @var $tokenName
	*/
	protected static $tokenName;

	/**
	* Setting token name
	* 
	*/
	public function __construct()
	{
		self::$tokenName = Config::get('session.token_name');
	}

	/**
	* Handle generate token
	*
	* @return md5 generate
	*/
	public static function generate()
	{
		return Session::put(self::$tokenName, md5(uniqid()));
	}

	/**
	* Handle to match token
	*
	* @return bool true | false
	*/
	public static function match($token)
	{
		if(Session::exists(self::$tokenName) && $token === Session::get(self::$tokenName)){
			Session::delete(self::$tokenName);
			return true;
		}
		return false;
	}
}