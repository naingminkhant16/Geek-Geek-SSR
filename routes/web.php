<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
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
    //Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    //Posts Management
    Route::get('/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    //show deleted posts
    Route::get('/posts/deleted-posts', [AdminPostController::class, 'deletedPosts'])->name('admin.posts.deletedPosts');
    //soft delete route
    Route::delete('/posts/{post}/soft-delete', [AdminPostController::class, 'softDelete'])->name('admin.posts.softDelete');
    //force delete route
    Route::delete('/posts/{id}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    //restore route
    Route::patch('/posts/{id}/restore', [AdminPostController::class, 'restore'])->name('admin.posts.restore');

    //User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    //Change Role
    Route::patch('/users/{user:username}/change-role', [AdminUserController::class, 'changeRole'])->name('admin.users.changeRole');
    //Soft Delete
    Route::delete('/users/{user}/soft-delete', [AdminUserController::class, 'softDelete'])->name('admin.users.softDelete');
    //show deleted users
    Route::get('/users/deleted-users', [AdminUserController::class, 'deletedUsers'])->name('admin.users.deletedUsers');
    //force delete route
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    //restore route
    Route::patch('/users/{id}/restore', [AdminUserController::class, 'restore'])->name('admin.users.restore');
});

//verify email
Route::get("/email-verify/{user}/{token}", [AuthController::class, 'verifyEmail'])->name('emailVerify');

//mails templates
Route::get('/mails/{name}', function ($name) {
    return view("Mails." . $name);
});
