<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Repositories\SeasonRepo;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    private $seasonRepo;

    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->seasonRepo = $seasonRepo;
    }

    public function create(Course $course)
    {
        $seasons = $this->seasonRepo->getCourseSeasons($course);
        return view('Course::lessons.create', compact('seasons', 'course'));
    }
}
