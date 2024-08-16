<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('Lang')) {
            $locale = $request->header('Lang');
            if (! in_array($locale, ['en', 'ar', 'nl'])) {
                abort(400);
            } else {
                App::setLocale($locale);
                Session::put(['local',$locale]);
                error_log("11111");
                error_log(app()->getLocale());
                error_log("11111");
            }
        } elseif (Session::has('locale')) {
            app()->setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
