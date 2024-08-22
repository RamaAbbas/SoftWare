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
        $defaultLocale = 'en';
        $local = $request->header('Accept-Language'); //?? $defaultLocale;
        if ($request->hasHeader('Accept-Language' || 'Lang')) {
            $locale = $request->header('Accept-Language');
            if (! in_array($locale, ['en', 'nl'])) {
                abort(400);
            } else {
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        } elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale($local);
        }

        return $next($request);
    }
}
