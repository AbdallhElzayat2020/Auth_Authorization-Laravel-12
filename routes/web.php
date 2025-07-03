<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ChangePasswordController;

Route::get('/', function () {
    return view('index');
});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');


Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::view('profile', 'auth.profile')->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');


    Route::put('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});