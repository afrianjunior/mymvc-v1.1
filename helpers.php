<?php

/**
* ----------------------------------------------------------------------------------
* Handle redirect to directory views/
* ----------------------------------------------------------------------------------
*/

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

/**
* ----------------------------------------------------------------------------------
* Handle convert env.json to array
* ----------------------------------------------------------------------------------
*/

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

/**
* ----------------------------------------------------------------------------------
* Handle convert string like Hello World to hello-world for uri
* ----------------------------------------------------------------------------------
*/

if(!function_exists('slug')){
	function slug($str){
		$str = preg_replace('/[^a-zA-Z0-9-]+/', '-', strtolower($str));
		return $str;
	}
}

/**
* ----------------------------------------------------------------------------------
* Handle assets for redirect to directory assets/
* ----------------------------------------------------------------------------------
*/

if(!function_exists('assets')){
	function assets($path){
		return BASE_URL . 'assets/' . $path;
	}
}

/**
* ----------------------------------------------------------------------------------
* Handle resources for get a files from directory app/resource/uploads
* ----------------------------------------------------------------------------------
*/

if(!function_exists('uploads')){
	function uploads($file){
		return BASE_URL . 'app/resources/uploads' . $file;
	}
}