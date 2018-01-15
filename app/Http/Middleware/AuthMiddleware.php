<?php

namespace App\Middleware;

use App\Session;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
    	$sessionToken = $request->session()->get('AUTH_SESSION_TOKEN');

    	$session = Session::where('token', $sessionToken)
    					->with('user')
    					->first();

    	if (! $session || ! $session->isValid()) {
    		return redirect('/');
    	}

        return $next($request);
    }
}
