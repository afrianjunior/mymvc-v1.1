<?php

$router = new AltoRouter();


$router->map('GET','/', 'HomeController@index','home');

$match = $router->match();

list($controller, $method ) = explode('@', $match['target']);

if(isset($controller)){
	if(is_callable($controller, $method)){
		$object = new $controller;
		call_user_func_array([$controller, $method], $match['params']);
	}
}



