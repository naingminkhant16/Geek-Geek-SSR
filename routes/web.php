<?php

use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminEmailController;
use App\Http\Controllers\AdminEmailReplyController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\PasswordController;
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

    //report post
    Route::post('/posts/report', [PostController::class, 'report'])->name('posts.report');

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
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login',  [AuthController::class, 'attemptLogin'])->name('attemptLogin');
    //register
    Route::get('/register',  [AuthController::class, 'register'])->name('register');
    Route::post('/register',  [AuthController::class, 'attemptRegister'])->name('attemptRegister');

    //verify email
    Route::get("/email-verify/{user}/{token}", [AuthController::class, 'verifyEmail'])->name('emailVerify');

    //mails templates
    Route::get('/mails/{name}', function ($name) {
        return view("Mails." . $name);
    });

    //password reset
    //forgot password form view
    Route::get('/forgot-password', [PasswordController::class, 'request'])->name('password.request');

    //handle forgot password form request
    Route::post('/forgot-password', [PasswordController::class, 'email'])->name('password.email');

    //reset password form view
    Route::get('/reset-password/{token}', [PasswordController::class, "reset"])->name('password.reset');

    //handle reset password form
    Route::post('/reset-password', [PasswordController::class, "update"])->name('password.update');

    // Route::get('/notification', function () {
    //     return (new PostCreated)
    //         ->toMail('test@gmail.com');
    // });
});

//Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    //Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.index');

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
    //Create New User
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    //Store new user
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
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

    //Email Management
    Route::get('/emails', [AdminEmailController::class, 'index'])->name('admin.emails.index');
    Route::get('/emails/create', [AdminEmailController::class, 'create'])->name('admin.emails.create');
    Route::post('/emails/store', [AdminEmailController::class, 'store'])->name('admin.emails.store');
    Route::get('/emails/{email}', [AdminEmailController::class, "show"])->name("admin.emails.show");
    //Email Reply Create
    Route::get('/emails/{email}/reply/create', [AdminEmailReplyController::class, "create"])->name("admin.emails.reply.create");
    Route::post('/emails/reply/store', [AdminEmailReplyController::class, 'store'])->name('admin.emails.reply.store');
    //Email Verify
    Route::post("/emails/verify/{user}", [AdminEmailController::class, "sendEmailVerify"])->name("admin.emails.verify");

    //Contact Messages
    Route::get('/contact-messages', [AdminContactController::class, "index"])->name("admin.contact-messages.index");
    Route::patch('/contact-messages/{contact}/mark-as-read', [AdminContactController::class, 'markAsRead'])
        ->name('admin.contact-messages.markAsRead');
    Route::delete('/contact-messages/{contact}', [AdminContactController::class, 'delete'])->name('admin.contact-message.delete');
});

//contact us
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us.store');

//About Me
Route::get('/about-me', function () {
    return view('Public.about');
})->name('about-me');
