<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\AuthRepository;
use App\Session;

class AuthController extends Controller
{
	private $auth;

	public function __construct()
	{
	}

	public function getLogin()
	{
		return view('auth.login');
	}

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required|min:5'
		]);
		
		$authRepository = new AuthRepository;

		return $authRepository
					->loginWithCredentials([
						'username' => $request->get('username'),
						'password' => $request->get('password'),
					]);
		
	}

	public function anyLogout(Session $session)
	{
	}
}
