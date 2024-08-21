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
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if ($request->hasHeader('local')) {
    //         $locale = $request->header('Accept-Language');
    //         if (! in_array($locale, ['en', 'nl'])) {
    //             abort(400);
    //         } else {
    //             App::setLocale($locale);
    //           //  Session::put(['local',$locale]);
    //             error_log("11111");
    //             error_log(app()->getLocale());
    //             error_log("11111");
    //         }
    //     } elseif (Session::has('local')) {
    //         app()->setLocale(Session::get('local'));
    //     }
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next): Response
    {

        $supportedLocales = ['en', 'nl'];
        $defaultLocale = 'en';


        if ($request->hasHeader('Accept-Language')) {
            $locale = $request->header('Accept-Language');
            if (in_array($locale, $supportedLocales)) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            } else {
                App::setLocale($defaultLocale);
            }
        } elseif (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale($defaultLocale);
        }

        return $next($request);
    }
}