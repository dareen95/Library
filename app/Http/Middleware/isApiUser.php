<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class isApiUser
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
        $api_token = $request->api_token;
        $user = User::where('api_token', '=', $api_token)->first();

        if ( $request->has('api_token') ) {
            if ($api_token !== NULL) {
                if ($user !== null) {
                    return $next($request); //go on
                } else {
                    $error = "token not correct";
                    return response()->json($error);
                }
            } else {
                $error = "token is empty";
                return response()->json($error);
            }
        } else {
            $error = "there is no token";
            return response()->json($error);    
        }
    }
}
