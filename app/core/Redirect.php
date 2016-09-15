<?php

class Redirect
{
	/**
	* Handle redirect with location
	*
	* @param $loaction dir /..
	*/
	public static function to($location)
	{
		if($location){
			if(is_numeric($location)){
				switch ($location) {
					case 404:
						header('HTTP/1.1 404 not found');
						exit();
						break;
				}
			}
			header('Location:' . $location);
			exit();
		}
		return false;
	}

	/**
	* Handle redirect back with flash messages
	*
	* @param $loaction back dir /..
	*/
	public static function back(array $data = [])
	{
		if(count($data)) {
			Session::flash($data['key'], $data['values']);
		}
		header('Location:' . $_SERVER['HTTP_REFERER']);
	}
}