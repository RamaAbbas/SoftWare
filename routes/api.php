<?php

use App\Http\Controllers\ServicesController;
use App\Http\Middleware\SetLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/services',[ServicesController::class,'index'])->middleware([SetLocal::class]);
Route::get('/service/show/{id}',[ServicesController::class,'show']);
Route::post('/store-service',[ServicesController::class,'store']);
Route::post('/update-service/{id}',[ServicesController::class,'update']);
Route::delete('/delete-service/{id}',[ServicesController::class,'destroy']);


