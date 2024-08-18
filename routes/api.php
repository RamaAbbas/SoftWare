<?php

use App\Http\Controllers\AboutUsController;
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

    ////about us
    Route::get('/about-us', [AboutUsController::class, 'index']);
    Route::get('/about-us/show/{id}', [AboutUsController::class, 'show'])->name('aboutus.show');
});

//Route::post('/store-aboutus', [AboutUsController::class, 'store']);
