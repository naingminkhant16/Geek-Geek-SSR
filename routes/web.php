<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('Auth.index');
    })->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
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

//verify email
Route::get("/email-verify/{user}/{token}", [AuthController::class, 'verifyEmail'])->name('emailVerify');

//mails templates
Route::get('/mails/{name}', function ($name) {
    return view("Mails." . $name);
});
