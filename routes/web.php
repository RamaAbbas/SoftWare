<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TeamMemberController;
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
        Route::get('/edit/aboutus/{id}', [AboutUsController::class, 'edit'])->name('aboutus.edit');
        Route::post('/update-aboutus/{id}', [AboutUsController::class, 'update'])->name('aboutus.update');
        Route::delete('/delete-aboutus/{id}', [AboutUsController::class, 'destroy'])->name("aboutus.delete");



        ////////contact Us
        Route::get('/admin-contact-us', [ContactController::class, 'show_all'])->name('showall.contact-us');
        Route::get('/admin-contact-page', [ContactController::class, 'show_contactpage'])->name('showall.contact-page');

        ////////Projects
        Route::get('/admin-projects', [ProjectController::class, 'show_all'])->name('showall.projects');
        Route::get('/project/view/{id}', [ProjectController::class, 'view'])->name('project.view');
        Route::get('/add/project', [ProjectController::class, 'addproject'])->name('project.add');
        Route::post('/store-project', [ProjectController::class, 'store'])->name("project.store");
        Route::delete('/delete-project/{id}', [ProjectController::class, 'destroy'])->name("project.delete");
        Route::get('/edit/project/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::post('/update-project/{id}', [ProjectController::class, 'update'])->name('project.update');


        ////////////////////////////member
        Route::get('/admin-members', [TeamMemberController::class, 'show_all'])->name('showall.members');
        Route::get('/admin-home', [AboutUsController::class, 'show_home'])->name('showhome');
        Route::get('/add/member', [TeamMemberController::class, 'addmember'])->name('member.add');
        Route::post('/store-member', [TeamMemberController::class, 'store'])->name('member.store');
        Route::delete('/delete-member/{id}', [TeamMemberController::class, 'destroy'])->name("member.delete");
        Route::post('/update-member/{id}', [TeamMemberController::class, 'update'])->name('member.update');
        Route::get('/edit/member/{id}', [TeamMemberController::class, 'edit'])->name('member.edit');


        /////////////////////////Hero Section
        Route::get('/admin-hero-section', [HeroSectionController::class, 'show_all'])->name('showall.herosection');
        Route::get('/add/herosection', [HeroSectionController::class, 'addherosection'])->name('hero_section.add');
        Route::post('/store-herosection', [HeroSectionController::class, 'store'])->name('herosection.store');
        Route::delete('/delete-section/{id}', [HeroSectionController::class, 'destroy'])->name("section.delete");
        Route::get('/edit/section/{id}', [HeroSectionController::class, 'edit'])->name('section.edit');
    });


    Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
});
