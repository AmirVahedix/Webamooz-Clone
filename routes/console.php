<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('storage:clear', function() {
    $public_storage = Storage::disk('public');
    foreach ($public_storage->files() as $file) {
        if ($file == '.gitignore') continue;
        $public_storage->delete($file);
    }

    $private_storage = Storage::disk('private');
    foreach ($private_storage->files() as $file) {
        if ($file == '.gitignore') continue;
        $private_storage->delete($file);
    }

    $this->comment('storage cleared successfully');
})->purpose('Clear Uploaded files in storage');
