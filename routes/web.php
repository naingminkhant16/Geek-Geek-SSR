<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPhotoController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;


//OAuth Routes
//google
Route::get('/auth/redirect/google', [OAuthController::class, 'googleRedirect'])->name('googleRedirect');
Route::get('/auth/callback/google', [OAuthController::class, 'googleCallback']);

//github
Route::get('/auth/redirect/github', [OAuthController::class, 'githubRedirect'])->name('githubRedirect');
Route::get('/auth/callback/github', [OAuthController::class, 'githubCallback']);


//Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');

    //posts
    Route::resource('/posts', PostController::class);
    Route::post('/posts/like/{post}', [PostController::class, 'handleLikePost'])->name('posts.like');

    //photos
    Route::delete('/post-photos/{photo}', [PostPhotoController::class, 'delete'])->name('post-photos.delete');

    //logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //comments
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');

    //users
    Route::post('/users/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::post('/users/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');
    Route::get('/users/people-you-may-know', [UserController::class, 'peopleYouMayKnow'])->name('users.peopleYouMayKnow');
    Route::get('/users/{user:username}/followers', [UserController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user:username}/followings', [UserController::class, 'followings'])->name('users.followings');
    Route::get('/users/{user:username}', [UserController::class, 'show'])->name('users.show');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/{user:username}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});

//Public Routes
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    // Login
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'attemptLogin')->name('attemptLogin');
    //register
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'attemptRegister')->name('attemptRegister');
});

//Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
});

//verify email
Route::get("/email-verify/{user}/{token}", [AuthController::class, 'verifyEmail'])->name('emailVerify');

//mails templates
Route::get('/mails/{name}', function ($name) {
    return view("Mails." . $name);
});
