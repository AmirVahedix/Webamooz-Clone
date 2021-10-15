<?php

use AmirVahedix\User\Http\Controllers\Auth\ForgotPasswordController;
use AmirVahedix\User\Http\Controllers\Auth\LoginController;
use AmirVahedix\User\Http\Controllers\Auth\RegisterController;
use AmirVahedix\User\Http\Controllers\Auth\ResetPasswordController;
use AmirVahedix\User\Http\Controllers\Auth\VerificationController;
use AmirVahedix\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/request', [ForgotPasswordController::class, 'showVerifyCodeRequestForm'])
    ->name('password.request')->middleware('guest');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetCodeEmail'])
    ->name('password.email')->middleware(['throttle:5,1', 'guest']);

Route::get('password/verify', [ForgotPasswordController::class, 'showVerifyForm'])
    ->name('password.verify.form')->middleware('guest');
Route::post('password/verify', [ForgotPasswordController::class, 'verify'])
    ->name('password.reset.verify')->middleware('guest');

Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset')->middleware('auth');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update')->middleware('auth');

// Email Verification Routes...
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::post('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Admin User Routes
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::delete('users/{user}', [UserController::class, 'delete'])->name('users.destroy');

    Route::get('user/{user}/ban/toggle', [UserController::class, 'banToggle'])->name('users.ban.toggle');
    Route::patch('user/{user}/syncRoles', [UserController::class, 'syncRoles'])->name('users.syncRoles');
});

// User Profile Routes
Route::post('users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.avatar.update');
