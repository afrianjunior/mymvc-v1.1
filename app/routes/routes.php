<?php

$router = new AltoRouter();

/**
* -----------------------------------------------------------
* ROUTE YOUR APP
* -----------------------------------------------------------
* please enter your app route in here
*
*/

$router->map('GET','/', 'HomeController@index','home');
$router->map('GET','/admin/overview', 'Overview@index','admin-overview');

/**
* -----------------------------------------------------------
* URI AUTHENTICATION
* -----------------------------------------------------------
*/
$router->map('GET','/auth/login', 'Authentication@login','auth-login');
$router->map('POST','/auth/check', 'Authentication@check','auth-check');
$router->map('GET','/auth/logout', 'Authentication@logout','auth-logout');
$router->map('GET','/auth/register', 'Authentication@register','auth-register');
$router->map('POST','/auth/store', 'Authentication@store','auth-store');

$match = $router->match();

if(empty($match)){
	header('HTTP/1.1 404 Not Found');
	view(404);
	exit();
}

$GLOBALS['router'] = $router;

list($controller, $method ) = explode('@', $match['target']);

if(isset($controller)){
	if(is_callable($controller, $method)){
		$object = new $controller;
		call_user_func_array([$controller, $method], $match['params']);
	} else {
		throw new \Exception("Error {$controller} @ {$method}", 1);
	}
}



