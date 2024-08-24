<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\SetLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Authentication;



Route::middleware([SetLocal::class])->group(function () {

    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service/show/{id}', [ServicesController::class, 'show'])->name('service.show');
    Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");
    Route::post('/store-aboutus', [AboutUsController::class, 'store'])->name("about-us.store");
    ////about us
    Route::get('/about-us', [AboutUsController::class, 'index']);
    Route::get('/about-us/show/{id}', [AboutUsController::class, 'show'])->name('aboutus.show');




    //////contact
    Route::get('/contact-us', [ContactController::class, 'index']);
    Route::post('/store-contact', [ContactController::class, 'store']);
    Route::get('/contact-us/show/{id}', [ContactController::class, 'show']);
});

//Route::post('/store-aboutus', [AboutUsController::class, 'store']);
