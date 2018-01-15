<?php

namespace App\Repositories;

use App\User;
use App\Session;

use \Exception as ArgumentException;
use \Exception as AuthException;

class AuthRepository extends Repository
{
	public function __construct()
	{
	}

	public function loginWithCredentials(array $credentials)
	{
		if (!array_key_exists('username', $credentials)
			|| !array_key_exists('password', $credentials)) {
			throw new ArgumentException("Error Processing Request", 1);
		}

		$user = User::where('username', $credentials['username']);

		if (! $user) {
			throw new AuthException(__('auth.user_not_found'));
		}

		if (! $app('hash')->check($credentials['password'], $user->password)) {
			throw new AuthException("Error Processing Request", 1);
		}

		$session = new Session([
			'user_id' => $user->id,
			'token'   => generateRandomString()
		]);

		$session->save();

		return $session;
	}
}
