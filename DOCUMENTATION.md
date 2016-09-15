## ROUTE

go to directory app/routes/routes.php :

```php

$router->map('GET','/', 'HomeController@index','home');

```

## CONTROLLER

go to directory app/controllers/ :

```php

class HomeController
{
	public function index()
	{
		return view('home');	
	}
}

```

method index in HomeController redirect to views/home.php

## MODELS

go to directory app/models/ :

```php

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'users';

	protected $fillable = ['email','password'];

	public $timestamp = true;
}

```

## AUTHENTICATION

go to directory app/controllers/auth/Authentication.php :

```php

public function __construct()
{
	// set session name
	self::$sessionName = Config::get('session.session_name');
	// set redirect to if success login
	self::$redirectTo = '/admin/overview';
	// set redirect back
	self::$redirectBack = '/auth/login';
}

```
And in routes.php add 

```php

$router->map('GET','/auth/login', 'Authentication@login','auth-login');
$router->map('POST','/auth/check', 'Authentication@check','auth-check');
$router->map('GET','/auth/logout', 'Authentication@logout','auth-logout');
$router->map('GET','/auth/register', 'Authentication@register','auth-register');
$router->map('POST','/auth/store', 'Authentication@store','auth-store');

```

## VALIDATION

```php

$validation = new Validation;
$validation->validate(Input::all(),[
	'your-request' => 'required'
]);

// passed

$validation->passed();

// errors

$validation->errors();

```

