<?php

if(!function_exists('view')){
	function view($viewPath, array $data = [])
	{
		if($viewPath){
			$viewPath = explode('.', $viewPath);
			$router = $GLOBALS['router'];
			foreach ($data as $key => $value) {
				if(!is_string($key)){
					throw new \Exception("Please provide string for key data", 1);
				}
				$$key = $value;
			}
			$viewPath = 'views/' . implode('/', $viewPath) . '.php';
			if(!file_exists($viewPath)){
				throw new \Exception("File Not Exists In Path: {$viewPath}", 1);	
			}
			require_once $viewPath;
		}
	}
}

if(!function_exists('env')){
	function env($key){
		if(!is_string($key)){
			throw new Exception("Please provide key string", 1);
		}
		$json = file_get_contents('env.json');
		$data = (array) json_decode($json);
		return $data[$key];
	}
}