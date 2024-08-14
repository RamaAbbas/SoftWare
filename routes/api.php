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
    Route::post('/update-service/{id}', [ServicesController::class, 'update'])->name('service.edit');
    Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name("service.delete");
});

Route::get('/admin',[ServicesController::class, 'a'])->name('home');
Route::get('/a',[LoginController::class, 's'])->name('');
Route::post('/login',[LoginController::class, 'login'])->name('login');
Route::post('/register',[LoginController::class, 'register'])->name('register');
Route::get('/logi',[ServicesController::class, 'b']);
