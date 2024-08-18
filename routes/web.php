<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\SetLocal;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::redirect('/', 'api/login');

Route::middleware([SetLocal::class])->group(function () {
    Route::get('setlocale/{local}', function ($local) {

        if (! in_array($local, ['en', 'ar', 'nl'])) {
            error_log("TRUE.................");
            return redirect()->back();
        } else {
            // session(["local" => $locale]);
            App::setLocale($local);
            Session::put('local', $local);
            error_log($local);
            return redirect()->back();
            /* error_log("Fasle.................");
            app()->setLocale($local);//Session::get('locale')
            return redirect()->back();*/
        }
    });


});
