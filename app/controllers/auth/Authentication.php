<?php

class Authentication
{
	/**
	* @var $sessionName string
	*/
	protected static $sessionName;

	/**
	* @var $redirectTo string
	*/
	protected static $redirectTo;

	/**
	* @var $redirectBack string
	*/
	protected static $redirectBack;	

	/**
	* Set all property
	*/
	public function __construct()
	{
		// set session name
		self::$sessionName = Config::get('session.session_name');
		// set redirect to if success login
		self::$redirectTo = '/admin/overview';
		// set redirect back
		self::$redirectBack = '/auth/login';
	}

	/**
	* Handle login
	*
	* @return redirect to auth/login 
	*/
	public function login()
	{
		if(Session::exists(self::$sessionName)) {
			return Redirect::to(self::$redirectTo);
		} else {
			return view('auth.login');
		}		
	}

	/**
	* Handle get currentUser login
	*/
	public function user()
	{
		if(Session::exists(self::$sessionName)) {
			$currentSession = Session::get(self::$sessionName);
			$user = User::where('id', '=', $currentSession)->first();
			return $user;
		} else {
			return false;	
		}
	}

	/**
	* Handle logout
	*
	* @return redirect to /auth/login
	*/
	public function logout()
	{
		Session::delete(self::$sessionName);
		return Redirect::to(self::$redirectBack);
	}

	/**
	* Handle register for new user
	*
	* @return redirect to /auth/register
	*/
	public function register()
	{
		return view('auth.register');
	}

	/**
	* Handle check credential user
	*
	* @return bool true | false
	*/
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
				return Redirect::to(self::$redirectTo);
			} else {
				return Redirect::to(self::$redirectBack);
			}
		}
	}

	/**
	* Handle check credential user
	*
	* @return bool true | false
	*/
	private static function attempt($email, $password)
	{
		$user = User::where('email', '=', $email)->first();
		if(Hash::check($password, $user->password)){
			Session::put(self::$sessionName, $user->id);
			return true;
		}
		return false;
	}

	/**
	* Handle insert new user
	*
	* @return redirect to /auth/login
	*/
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
			return Redirect::to(self::$redirectBack);
		}
	}

}