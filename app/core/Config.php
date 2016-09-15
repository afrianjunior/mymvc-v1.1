<?php

class Config
{
	/**
	* Handle get file in directory config/common.php
	*
	* @param $path mixed | default null
	*/
	public static function get($path = null)
	{
		if($path) {
			$config = include __DIR__ . '/../config/common.php';
			$path = explode('.', $path);
			foreach ($path as $bit) {
				if(isset($config[$bit])){
					$config = $config[$bit];
				}
			}
			return $config;
		}
		return false;
	}
}