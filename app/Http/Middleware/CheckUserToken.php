<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUserToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find($request->id);

        // Check if id and token passed in request match and is valid
        if ( isset($user) && isset($request->api_token) && $request->api_token === $user->api_token && checkTokenExpiry($user->api_token_expiry) ) {

            $request->route()->setParameter('user', $user);
            return $next($request);

        }

        return response()->json([
            'success' => false,
            'error'   => 'Unauthorized' 
        ], 401);
    }
}
