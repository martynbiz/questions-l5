<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

use Illuminate\Http\Request;

use App\Services\Notify;

// EDIT: I've imported these functions in for clarity, and I want to change them for SSO
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar) // ** pass in Saml object
	{
		parent::__construct();
        
        $this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	
	
	
	
	
	
	// use AuthenticatesAndRegistersUsers;
	
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * The registrar implementation.
	 *
	 * @var Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function getRegister()
	// {
	// 	return $this->render('auth.register');
	// }

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Foundation\Http\FormRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	// public function postRegister(Request $request, Notify $notify)
	// {
	// 	// validate the new user
	// 	$validator = $this->registrar->validator($request->all());
		
	// 	// throw exception if validation fails
	// 	if ($validator->fails())
	// 	{
	// 		$this->throwValidationException(
	// 			$request, $validator
	// 		);
	// 	}
		
	// 	// create the new user
	// 	$user = $this->registrar->create( $request->all() );
		
	// 	// send notification email
 //        $notify->toNewUserReNewRegistration($user);
		
	// 	// log the user in
	// 	$this->auth->login($user);

	// 	return redirect($this->redirectPath());
	// }

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin(User $user)
	{
		// return $this->render('auth.login');
		$auth = new \SimpleSAML_Auth_Simple('qa-martyndev'); // ** get entity id from config
		
		// check login is required
		$auth->requireAuth();
		
		
		
		// ..sso login successful, let's proceed to login them in locally
		
		// get attributes to retrieve the username
		$attributes = $auth->getAttributes();
		
		// login the user with the sso attributes usernname
		$this->auth->loginByCredentials([
			'username' => $attributes['username'], // ** configurable credentials
		]);
		
		return redirect()->intended($this->redirectPath());
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	// public function postLogin(Request $request)
	// {
	// 	$this->validate($request, [
	// 		'email' => 'required', 'password' => 'required',
	// 	]);

	// 	$credentials = $request->only('email', 'password');

	// 	if ($this->auth->attempt($credentials, $request->has('remember')))
	// 	{
	// 		return redirect()->intended($this->redirectPath());
	// 	}

	// 	return redirect($this->loginPath())
	// 				->withInput($request->only('email', 'remember'))
	// 				->withErrors([
	// 					'email' => 'These credentials do not match our records.',
	// 				]);
	// }

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		// $this->auth->logout();
		$auth = new \SimpleSAML_Auth_Simple('qa-martyndev');
		
		$auth->logout();

		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	// public function loginPath()
	// {
	// 	return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
	// }

}
