<?php

use AmirVahedix\Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// prefix: categories

Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
