<?php

namespace AmirVahedix\Course\Listeners;

use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Repositories\CourseRepo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttendUserToCourseListener
{
    public function __construct()
    {

    }

    public function handle($event)
    {
        if ($event->payment->paymentable_type === Course::class) {
            resolve(CourseRepo::class)
                ->addStudentToCourse($event->payment->paymentable, $event->payment->buyer);
        }
    }
}
