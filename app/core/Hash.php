<?php

class Hash
{
	protected static $rounds = 10;

	public static function make($string, array $options = [])
	{
		$cost = isset($options['rounds']) ? $options['rounds'] : self::$rounds;
		return password_hash($string, PASSWORD_DEFAULT, ['cost' => $cost]);
	}

	public static function check($value, $hashed_value)
	{
		if(strlen($hashed_value) === 0){
			return false;
		}
		return password_verify($value, $hashed_value);
	}
}