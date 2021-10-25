<?php

use Illuminate\Support\Facades\Route;

Route::get('discount', function() {
    dd('ok');
})->name('admin.discounts.index');
