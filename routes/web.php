<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNewsController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/news')->group(function(){
     Route::get('/home',[UserNewsController::class,'index'])->name('user-view.index');
     Route::get('/category/{cat_id}',[UserNewsController::class,'newsByCat'])->name('user-view.showByCat');
     Route::get('/details/{id}',[UserNewsController::class,'show'])->name('user-view.show');
     Route::post('/contact',[ContactController::class,'store'])->name('contact.store');
     Route::get('/contact',[ContactController::class,'create'])->name('contact.create');
     Route::post('/comment',[CommentController::class,'store'])->name('comment.store');
     Route::post('/reply',[CommentController::class,'store'])->name('commentReply.store');

});
Route::prefix('/news')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'show_login'])->name('auth.show-login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'show_register'])->name('auth.show-register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/forgotPass', [AuthController::class, 'forgotPassword'])->name('password.show-forgotPassword');
    Route::post('/forgotPass', [AuthController::class, 'resetPasswordRequest'])->name('password.forgotPassword');
    Route::get('/reset/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset', [AuthController::class, 'resetForgotPassword'])->name('password.perform-reset');

   
});
Route::prefix('/news')->middleware(['auth'])->group(function () {
    
    Route::middleware('isAdmin')->group(function () {

        Route::get('/verification-notice', [AuthController::class, 'verificationNotice'])->name('verification.notice');
        Route::get('/verification-send', [AuthController::class, 'sendVerificationEmail'])->name('verification.send')->middleware('throttle:5,1');
        Route::get('/verify/{id}/{hash}', [AuthController::class, 'verify'])->name('verification.verify')->middleware('signed');
       
        Route::middleware('verified')->group(function () {

            Route::resource('/users', UserController::class);
            Route::resource('/news',NewsController::class);
            Route::post('/publish/{id}',[NewsController::class,'publish'])->name('news.publish');
            Route::post('/archive/{id}',[NewsController::class,'archive'])->name('news.archive');
        });
    });
   
    Route::get('/resetPassword', [AuthController::class, 'show_resetPassword'])->name('auth.resetPassword');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/updatePassword', [AuthController::class, 'updatePassword'])->name('auth.updatePassword');
});

