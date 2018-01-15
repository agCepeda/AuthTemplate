<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\AuthRepository;
use \Exception as AuthException;

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

		$session = null;

		try {
			$session = $authRepository->loginWithCredentials([
				'username' => $request->get('username'),
				'password' => $request->get('password'),
			]);
		} catch(AuthException $ex) {
			app('log')->debug($ex);
			return back()->withErrors($ex->getMessage());
		}


		return redirect('/');
	}

	public function anyLogout()
	{
	}
}
