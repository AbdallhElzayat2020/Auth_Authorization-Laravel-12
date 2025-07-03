<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
Route::get('/', function () {
    return view('index');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register');


Route::middleware('auth')->group(function () {
    Route::view('profile', 'auth.profile')->name('profile');
    Route::post('logout',[LogoutController::class, 'logout'])->name('logout');
});