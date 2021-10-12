<?php

use AmirVahedix\Authorization\Http\Controllers\AuthorizationController;
use Illuminate\Support\Facades\Route;

// prefix: authorization

Route::get('/', [AuthorizationController::class, 'index'])->name('admin.authorization.index');

Route::post('/', [AuthorizationController::class, 'store'])->name('admin.authorization.store');
