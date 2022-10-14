<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/register', 'register')->name('register');
});
