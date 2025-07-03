<?php

use App\Http\Controllers\Auth\ForgetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('show-login-form');
    Route::post('login', 'login')->name('login');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'showRegisterForm')->name('register');
    Route::post('register', 'register')->name('register');
});


Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('forget-password', 'showForgetPasswordForm')->name('password.request');
    Route::post('forget-password', 'sendResetEmail')->name('password.email');
});


Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('reset-password', 'updatePassword')->name('password.update');
});


Route::middleware('auth')->group(function () {
    Route::view('profile', 'auth.profile')->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    /* change password when auth in profile  */
    Route::put('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
});