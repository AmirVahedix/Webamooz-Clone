<?php

namespace Database\Seeders;

use AmirVahedix\Course\Database\Factories\LessonFactory;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static $seeders = [];

    public function run()
    {
        Lesson::factory()->count(5)->create();
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
