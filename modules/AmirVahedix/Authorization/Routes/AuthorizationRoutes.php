<?php

use AmirVahedix\Authorization\Http\Controllers\AuthorizationController;
use Illuminate\Support\Facades\Route;

// prefix: authorization

Route::get('/', [AuthorizationController::class, 'index'])->name('admin.authorization.index');

Route::post('/', [AuthorizationController::class, 'store'])->name('admin.authorization.store');

Route::get('/{role}', [AuthorizationController::class, 'edit'])->name('admin.authorization.edit');
Route::patch('/{role}', [AuthorizationController::class, 'update'])->name('admin.authorization.update');

Route::delete('/{role}', [AuthorizationController::class, 'delete'])->name('admin.authorization.delete');
