<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\SetLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Authentication;

Route::get('/', function () {
    return view('admin.login');
});

Route::middleware([SetLocal::class])->group(function () {


    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service/show/{id}', [ServicesController::class, 'show'])->name('service.show');
    Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");
    Route::get('/add/services', [ServicesController::class, 'addservice'])->name('service.add');
    Route::post('/update-service/{id}', [ServicesController::class, 'update'])->name('service.update');
    Route::get('/edit/services/{id}', [ServicesController::class, 'edit'])->name('service.edit');
    Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name("service.delete");



    Route::get('/admin', [LoginController::class, 'home'])->name('home');
    Route::get('/admin-services', [ServicesController::class, 'show_all'])->name('showall.service');
    Route::get('/login', [LoginController::class, 'view'])->name('admin.login');


    Route::middleware([Authentication::class])->group(function () {});
});



Route::post('/login', [LoginController::class, 'login'])->name('login');








/*
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
    /*    }
    });

      Route::get('/admin-services', [ServicesController::class, 'show_all'])->name('showall.service');
    Route::get('/login', [LoginController::class, 'view'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');


    Route::get('/admin', [LoginController::class, 'home'])->name('home');

*/
