<?php

class Overview
{
	public function __construct()
	{
		if(Session::exists(Config::get('session.session_name'))){
			return true;
		} else {
			return Redirect::to('/auth/login');
		}
	}

	public function index()
	{
		$auth = new Authentication;
		$currentUser = $auth->user();
		return view('admin.overview', compact('currentUser'));
	}
}