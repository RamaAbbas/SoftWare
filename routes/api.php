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

    Route::get('setlocale/{locale}', function ($locale) {

        if (! in_array($locale, ['en', 'ar', 'nl'])) {
            return redirect()->back();
        } else {
            Session::put('locale', $locale);
            App::setLocale($locale);
            app()->setLocale(Session::get('locale'));
            return redirect()->back();
        }
    });
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service/show/{id}', [ServicesController::class, 'show'])->name('service.show');
    Route::post('/store-service', [ServicesController::class, 'store']);
    Route::post('/update-service/{id}', [ServicesController::class, 'update'])->name('service.update');
    Route::get('/edit/services/{id}', [ServicesController::class, 'edit'])->name('service.edit');
    Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name("service.delete");
});
Route::get('/login', [LoginController::class, 'view'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::middleware([Authentication::class])->group(function () {
Route::get('/admin', [LoginController::class, 'home'])->name('home');
Route::get('/admin-services', [ServicesController::class, 'show_all'])->name('showall.service');
Route::post('/register', [LoginController::class, 'register'])->name('register');

});
