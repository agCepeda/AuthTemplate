<?php

namespace App\Middleware;

use App\Session;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $authToken = $request->headers()->get('Authorization');

        if (! $authToken) {
            $authToken = $request->get('authToken');
        }

    	$session = Session::where('token', $authToken)
    					->with('user')
    					->first();

    	if (! $session || ! $session->isValid()) {
            return response()->json(['message' => 'Mensaje de error.']);
    	}

        return $next($request);
    }
}
