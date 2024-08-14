<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use App\Http\Middleware\SetLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware([SetLocal::class])->group(function () {
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service/show/{id}', [ServicesController::class, 'show']);
    Route::post('/store-service', [ServicesController::class, 'store']);
    Route::post('/update-service/{id}', [ServicesController::class, 'update']);
    Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy']);
});

Route::get('/admin',[ServicesController::class, 'a'])->name('home');
Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::get('/logi',[ServicesController::class, 'b']);
