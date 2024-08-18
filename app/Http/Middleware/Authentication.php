<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        error_log('1111111');
        error_log($request->all);
        error_log(Auth::check()==null);

        if (Auth::check()) {
            error_log('444444444');
            return $next($request);
        }
        if(Auth::user() || auth()->user() || auth()->guard('api')->user()){
            error_log('88888888888888');
        }
        /*  elseif (!Auth::guard('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }*/

        //return $next($request);

        return response()->json(['error' => 'Unauthorized'], 401); //redirect()->route('login');
    }
}
