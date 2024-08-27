<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
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

        if (! in_array($local, ['en', 'nl'])) {

            return redirect()->back();
        } else {
            App::setLocale($local);
            Session::put('locale', $local);
            return  redirect()->back();
        }
    });
    Route::middleware([\App\Http\Middleware\Authentication::class])->group(function () {


        Route::get('/add/services', [ServicesController::class, 'addservice'])->name('service.add');
        //  Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");
        Route::post('/update-service/{id}', [ServicesController::class, 'update'])->name('service.update');
        Route::get('/edit/services/{id}', [ServicesController::class, 'edit'])->name('service.edit');
        Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name("service.delete");
        // Route::get('/admin', [LoginController::class, 'home'])->name('home');
        Route::get('/admin-services', [ServicesController::class, 'show_all'])->name('showall.service');
        Route::get('/service/view/{id}', [ServicesController::class, 'view'])->name('service.view');


        Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");



        //////////About Us
        Route::get('/add/about-us', [AboutUsController::class, 'addaboutus'])->name('about-us.add');
        Route::get('/admin-about-us', [AboutUsController::class, 'show_all'])->name('showall.about-us');
        Route::post('/store-aboutus', [AboutUsController::class, 'store'])->name("about-us.store");



        ////////contact Us
        Route::get('/admin-contact-us', [ContactController::class, 'show_all'])->name('showall.contact-us');

        ////////Projects
        Route::get('/admin-projects', [ProjectController::class, 'show_all'])->name('showall.projects');
        Route::get('/project/view/{id}', [ProjectController::class, 'view'])->name('project.view');
        Route::get('/add/project', [ProjectController::class, 'addproject'])->name('project.add');
        Route::post('/store-project', [ProjectController::class, 'store'])->name("project.store");
    });


    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});
