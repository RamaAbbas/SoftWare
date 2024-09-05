<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Middleware\SetLocal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Authentication;



Route::middleware([SetLocal::class])->group(function () {

    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service/show/{id}', [ServicesController::class, 'show'])->name('service.show');
    // Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");

    ////about us
    Route::get('/about-us', [AboutUsController::class, 'index']);
    Route::get('/about-us/show/{id}', [AboutUsController::class, 'show'])->name('aboutus.show');
    //  Route::post('/store-aboutus', [AboutUsController::class, 'store'])->name("about-us.store");
    // Route::post('/update-aboutus/{id}', [AboutUsController::class, 'update'])->name("about-us.update");




    //////contact
    Route::get('/contact-us', [ContactController::class, 'index']);
    Route::post('/store-contact', [ContactController::class, 'store']);
    Route::get('/contact-us/show/{id}', [ContactController::class, 'show']);
    Route::post('/store-contactpage', [ContactController::class, 'storecontactPage']);


    ////////////////Projects
   // Route::post('/store-project', [ClientController::class, 'store'])->name("project.store");
    Route::post('/store-project', [ProjectController::class, 'store']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/project/show/{id}', [ProjectController::class, 'show']);


    Route::get('/home', [AboutUsController::class, 'home']);

    /////////////////////hero

    Route::post('/store-herosection', [HeroSectionController::class, 'store']);


    /////////////////////////team member
    Route::post('/store-member', [TeamMemberController::class, 'store']);
});

//Route::post('/store-aboutus', [AboutUsController::class, 'store']);
