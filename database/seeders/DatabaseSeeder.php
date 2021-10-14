<?php

namespace Database\Seeders;

use AmirVahedix\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static $seeders = [];

    public function run()
    {
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
