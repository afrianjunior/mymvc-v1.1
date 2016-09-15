<?php

class Overview
{
	public function __construct()
	{
		if(Session::exists(Config::get('session.session_name'))){
			return true;
		} else {
			return Redirect::to('/');
		}
	}

	public function index()
	{
		$user = new Authentication;
		$currentUser = $user->user();
		return view('admin.overview', compact('currentUser'));
	}
}