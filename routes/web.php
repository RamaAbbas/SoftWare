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


Route::get('/', function () {
    return view('admin.login');
});
Route::middleware([SetLocal::class])->group(function () {
    Route::get('setlocale/{local}', function ($local) {

        if (! in_array($local, ['en', 'ar', 'nl'])) {

            return redirect()->back();
        } else {
            App::setLocale($local);
            Session::put('local', $local);
            return redirect()->back();
        }
    });
    Route::middleware([\App\Http\Middleware\Authentication::class])->group(function () {

        Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");
        Route::get('/add/services', [ServicesController::class, 'addservice'])->name('service.add');
        Route::post('/update-service/{id}', [ServicesController::class, 'update'])->name('service.update');
        Route::get('/edit/services/{id}', [ServicesController::class, 'edit'])->name('service.edit');
        Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name("service.delete");
       // Route::get('/admin', [LoginController::class, 'home'])->name('home');
        Route::get('/admin-services', [ServicesController::class, 'show_all'])->name('showall.service');
    });

    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');

});
