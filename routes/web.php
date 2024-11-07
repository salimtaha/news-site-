<?php

use App\Models\Post;
use App\Models\User;
use App\Jobs\emailJop;
use App\Jobs\firstTask;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\WhatsappNotifications;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Auth\LoginSocialiteController;
use App\Http\Controllers\Frontend\NewsSubscriberController;
use App\Http\Controllers\Frontend\Dashboard\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\SettingController;
use App\Http\Controllers\Frontend\Dashboard\NotificationController;


Route::redirect('/', '/home');

Route::group([
    'as' => 'frontend.',
], function () {
    Route::fallback(function(){
        return response()->view('errors.404');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::post('news-subscribe', [NewsSubscriberController::class, 'store'])->name('news.subscrice');
    Route::get('category/{slug}', CategoryController::class)->name('category.posts');

    // Post Routes
    Route::controller(PostController::class)->name('post.')->prefix('post')->group(function () {
        Route::get('/{slug}', 'show')->name('show');
        Route::get('/comments/{slug}', 'getAllPosts')->name('getAllComments');
        Route::post('/comments/store', 'saveComment')->name('comments.store');
    });

    Route::controller(ContactController::class)->name('conact.')->prefix('contact-us')->group(function () {
        Route::get('/',  'index')->name('index');
        Route::post('/store',  'store')->name('store');
    });

    Route::match(['get', 'post'], 'search', SearchController::class)->name('search');

    Route::prefix('account/')->name('dashboard.')->middleware(['auth:web', 'verified' ,  'checkUserStatus'])->group(function () {

        //  manage profile page
        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'index')->name('profile');
            Route::post('post/store', 'storePost')->name('post.store');
            Route::delete('post/delete', 'deletePost')->name('post.delete');
            Route::get('post/get-comments/{id}', 'getComments')->name('post.getComments');

            Route::get('post/{slug}/edit', 'showEditForm')->name('post.edit');
            Route::put('post/update' , 'updatePost')->name('post.update');
            Route::post('post/image/delete/{image_id}' , 'deletePostImage')->name('post.image.delete');
        });
        // setting routes
        Route::prefix('setting')->controller(SettingController::class)->group(function(){
            Route::get('/' , 'index')->name('setting');
            Route::post('/update' , 'update')->name('setting.update');
            Route::post('/change-password' , 'changePassword')->name('setting.changePassword');
        });
        // Notification Routes
        Route::prefix('notification')->controller(NotificationController::class)->group(function(){
            Route::get('/' , 'index')->name('notifications.index');
            Route::get('/read-all' , 'readAll')->name('notifications.readAll');
            Route::post('/delete' , 'delete')->name('notifications.delete');
            Route::get('/delete-all' , 'deleteAll')->name('notifications.deleteAll');
        });

    });

    Route::get('wait' , function(){
          return view('frontend.wait');
    })->name('wait');

});



Route::prefix('email')->name('verification.')->controller(VerificationController::class)->group(function () {
    Route::get('/verify',              'show')->name('notice');
    Route::get('/verify/{id}/{hash}',  'verify')->name('verify');
    Route::post('/resend',             'resend')->name('resend');
});

Auth::routes();

Route::get('auth/{provider}/redirect' , [SocialLoginController::class , 'redirect'])->name('auth.socilate.redirect');
Route::get('auth/{provider}/callback' , [SocialLoginController::class , 'callback'])->name('auth.socilate.callback');


