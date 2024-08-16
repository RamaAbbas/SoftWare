<?php

use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::redirect('/', 'api/login');

