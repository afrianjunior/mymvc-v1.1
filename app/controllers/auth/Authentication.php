<?php

class Authentication
{
	public function login()
	{
		if(Session::exists(Config::get('session.session_name'))){
			return Redirect::to('/admin/overview');
		} else {
			return view('auth.login');
		}		
	}

	public function user()
	{
		if(Session::exists(Config::get('session.session_name'))){
			$currentSession = Session::get(Config::get('session.session_name'));
			$user = User::where('id', '=', $currentSession)->first();
			return $user;
		}
		return false;
	}

	public function logout()
	{
		Session::delete(Config::get('session.session_name'));
		return Redirect::to('/auth/login');
	}

	public function register()
	{
		return view('auth.register');
	}

	public function check()
	{
		if(!Token::match(Input::get('token'))){
			return Redirect::back();
		}
		$validation = new Validation;
		$validation->validate(Input::all(), [
			'email' => 'required',
			'password' => 'required'
		]);
		if(!$validation->passed()){
			return Redirect::back(['key' => 'errors', 'values' => $validation->errors()]);
		} else {
			$email = Input::get('email');
			$password = Input::get('password');
			$login = self::attempt($email, $password);
			if($login){
				return Redirect::to('/admin/overview');
			} else {
				return Redirect::to('/auth/login');
			}
		}
	}

	private static function attempt($email, $password)
	{
		$user = User::where('email', '=', $email)->first();
		if(Hash::check($password, $user->password)){
			Session::put(Config::get('session.session_name'), $user->id);
			return true;
		}
		return false;
	}

	public function store()
	{
		if(!Token::match(Input::get('token'))){
			return Redirect::back();
		}
		$validator = new Validation;
		$validator->validate(Input::all(),array(
			'email' => 'required|unique:users',
			'password' => 'required|min:3',
			'password_confirmation' => 'required|matches:password'
		));
		if(!$validator->passed()) {
			return Redirect::back(['key' => 'errors', 'values' => $validator->errors()]);
		} else {
			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('/auth/login');
		}
	}

}