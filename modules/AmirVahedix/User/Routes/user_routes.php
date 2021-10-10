<?php

use AmirVahedix\User\Http\Controllers\Auth\ForgotPasswordController;
use AmirVahedix\User\Http\Controllers\Auth\LoginController;
use AmirVahedix\User\Http\Controllers\Auth\RegisterController;
use AmirVahedix\User\Http\Controllers\Auth\ResetPasswordController;
use AmirVahedix\User\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/request', [ForgotPasswordController::class, 'showVerifyCodeRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetCodeEmail'])
    ->name('password.email')->middleware('throttle:5,1');

Route::get('password/verify', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify.form');
Route::post('password/verify', [ForgotPasswordController::class, 'verify'])->name('password.reset.verify');

Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset')->middleware('auth');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])
    ->name('password.update')->middleware('auth');

// Email Verification Routes...
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::post('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
