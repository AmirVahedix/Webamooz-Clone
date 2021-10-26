<?php

use AmirVahedix\Discount\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DiscountController::class, 'index'])
    ->name('admin.discounts.index');

Route::post('/', [DiscountController::class, 'store'])
    ->name('admin.discounts.store');

Route::get('/{discount}/edit', [DiscountController::class, 'edit'])
    ->name('admin.discounts.edit');

Route::patch('/{discount}/update', [DiscountController::class, 'update'])
    ->name('admin.discounts.update');

Route::delete('/{discount}/delete', [DiscountController::class, 'delete'])
    ->name('admin.discounts.destroy');

Route::get('/{code}/{course}/check', [DiscountController::class, 'check'])
    ->name('discounts.check');
