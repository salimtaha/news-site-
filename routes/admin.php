<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Admin\Authorization\AuthorizationController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\GereralSearchController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Setting\RelatedSiteController;
use App\Http\Controllers\Admin\Setting\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// auth admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login.show');
        Route::post('login/check', 'checkAuth')->name('login.check');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::group(['prefix'=>'password' , 'as'=>'password.'] , function(){
        Route::controller(ForgetPasswordController::class)->group(function(){
            Route::get('email' ,'showEmailForm')->name('email');
            Route::post('email' ,'sendOtp')->name('sendotp');
            Route::get('verify/{email}' ,'showOtpForm')->name('showOtpForm');
            Route::post('verify/' ,'verifyOtp')->name('verifyOtp');
        });

        Route::get('reset/{email}', [ResetPasswordController::class , 'showResetForm'])->name('resetform');
        Route::post('reset', [ResetPasswordController::class , 'resetPassword'])->name('reset');
    });

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' =>[ 'auth:admin' , 'checkAdminStatus']], function () {
    Route::fallback(function(){
        return response()->view('errors.404');
    });
    //******************** Home Page Routes **************************
    Route::get('home' ,        [HomeController::class , 'index'])->name('home');
    //******************** Generl Search Routes **************************
    Route::get('search', [GereralSearchController::class , 'search'])->name('search');

    //********************  Resources Routes **************************
    Route::resource('authorizations' ,      AuthorizationController::class);
    Route::resource('users' ,               UserController::class);
    Route::resource('categories' ,          CategoryController::class);
    Route::resource('posts' ,               PostController::class);
    Route::resource('admins' ,              AdminController::class);
    Route::resource('related-site' , RelatedSiteController::class);

    Route::get('categories/status/{id}' ,         [CategoryController::class , 'changeStatus'])->name('categories.changeStatus');
    Route::get('posts/status/{id}' ,              [PostController::class , 'changeStatus'])->name('posts.changeStatus');
    Route::get('posts/comment/delete/{id}' ,      [PostController::class , 'deleteComment'])->name('posts.deleteComment');
    Route::post('posts/image/delete/{image_id}' , [PostController::class,  'deletePostImage'])->name('posts.image.delete');
    Route::get('users/status/{id}' ,              [UserController::class , 'changeStatus'])->name('users.changeStatus')->middleware('can:users');;
    Route::get('admins/status/{id}' ,             [AdminController::class , 'changeStatus'])->name('admins.changeStatus');

     //******************** Profile Routes **************************
     Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/update' , 'update')->name('update');
    });
     //******************** Setting Routes **************************
     Route::controller(SettingController::class)->prefix('settings')->as('settings.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::post('/update' , 'update')->name('update');
    });

      //******************** contact Routes **************************
      Route::controller(ContactController::class)->prefix('contacts')->as('contacts.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::get('/destroy/{id}' , 'destroy')->name('destroy');
    });

      //******************** Notifications Routes **************************
      Route::controller(NotificationController::class)->prefix('notifications')->as('notifications.')->group(function(){
        Route::get('/' , 'index')->name('index');
        Route::get('/destroy/{id}' , 'destroy')->name('destroy');
        Route::get('/delete-all' , 'deleteAll')->name('deleteAll');
    });

});
Route::get('admin/wait' , function(){
    return view('admin.wait');
})->name('admin.wait');

