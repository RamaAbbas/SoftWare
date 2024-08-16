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
            error_log("TRUE.................");
            return redirect()->back();
        } else {
           // Session::put('locale', $locale);
            App::setLocale($locale);
            error_log("Tasle.................");
          //  app()->setLocale(Session::get('locale'));
            return redirect()->back();
        }
    });
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/service/show/{id}', [ServicesController::class, 'show'])->name('service.show');
    Route::post('/store-service', [ServicesController::class, 'store'])->name("service.store");
    Route::get('/add/services', [ServicesController::class, 'addservice'])->name('service.add');
    Route::post('/update-service/{id}', [ServicesController::class, 'update'])->name('service.update');
    Route::get('/edit/services/{id}', [ServicesController::class, 'edit'])->name('service.edit');
    Route::delete('/delete-service/{id}', [ServicesController::class, 'destroy'])->name("service.delete");
});






Route::get('/admin-services', [ServicesController::class, 'show_all'])->name('showall.service');
Route::get('/login', [LoginController::class, 'view'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/admin', [LoginController::class, 'home'])->name('home');

Route::middleware([Authentication::class])->group(function () {


    Route::post('/register', [LoginController::class, 'register'])->name('register');
});

Route::get('/admin-services/{id}/{content}', [ServicesController::class, 'getcontent'])->name('getcontent.service');



/*
 <div class="col-md-6 col-sm-6">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2><i class="fa fa-bars"></i> {{ $service->name }} <small></small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                </div>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                            <li class="" id="">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href=""
                                                    role="tab" aria-controls="home" aria-selected="true">Description</a>
                                            </li>
                                            <li class="nav-item" id="">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href=""
                                                    role="tab" aria-controls="profile"
                                                    aria-selected="false">Requirments</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                                    role="tab" aria-controls="contact" aria-selected="false">Coast</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href=""
                                                    role="tab" aria-controls="contact" aria-selected="false">For
                                                    Howm</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="description-id" role="tabpanel"
                                                aria-labelledby="home-tab" style="display:block">
                                                <p id="description">{{ $service->description }}</p>
                                            </div>
                                            <div class="tab-pane fade" id="requirments-id" role="tabpanel"
                                                aria-labelledby="profile-tab">
                                                <p id="requirments"> {{ $service->requirments }}</p>
                                            </div>
                                            <div class="tab-pane fade" id="coast-id" role="tabpanel"
                                                aria-labelledby="contact-tab">
                                                <p id="coast"> {{ $service->coast }}</p>
                                            </div>
                                            <div class="tab-pane fade" id="for_whom-id" role="tabpanel"
                                                aria-labelledby="contact-tab">
                                                <p id="for_whom"> {{ $service->for_whom }}</p>
                                            </div>
                                            <div class="a">
                                                <h3 class="a">{{ $service->description }}</h3>
                                            </div>
                                            <div class="b">
                                                <h3>{{ $service->requirments }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>*/
