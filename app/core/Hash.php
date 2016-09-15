<?php

class Hash
{
	/**
	* @var $rounds interger
	*/
	protected static $rounds = 10;

	/**
	* Handle make hashed string to encrypt
	* 
	* @param $str string 
	* @param $options array
	*/
	public static function make($str, array $options = [])
	{
		$cost = isset($options['rounds']) ? $options['rounds'] : self::$rounds;
		return password_hash($string, PASSWORD_DEFAULT, ['cost' => $cost]);
	}

	/**
	* Handle check hashed string
	* 
	* @param $value string 
	* @param $hashedValue encrypt
	* @return bool true | false
	*/
	public static function check($value, $hashedValue)
	{
		if(strlen($hashedValue) === 0){
			return false;
		}
		return password_verify($value, $hashedValue);
	}
}