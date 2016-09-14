<?php

return [
	/**
	* ----------------------------------------
	* Setting cookie
	* ----------------------------------------
	*/
	'remember' => [
		'cookie_name' => '_mymvc',
		'cookie_expiry' => 3600
	],
	
	/**
	* ----------------------------------------
	* Setting session
	* ----------------------------------------
	*/
	'session' => [
		'session_name' => '_user',
		'token_name' => '_token'
	]
];