<?php


namespace AmirVahedix\Front\Http\Controllers;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Course\Repositories\LessonRepo;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    private $lessonRepo;

    public function __construct(LessonRepo $lessonRepo)
    {
        $this->lessonRepo = $lessonRepo;
    }

    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $lessons = $this->lessonRepo->getAcceptedLessons($course);

        return view('Front::course', compact('course', 'lessons'));
    }

    public function shortCourseLink($course_id)
    {
        $course = Course::findOrFail($course_id);
        return redirect()->route('courses.single', $course->slug);
    }

    public function showLesson($course_slug, $lesson_number)
    {
        $course = Course::where('slug', $course_slug)->first();
        $lesson = Lesson::where('course_id', $course->id)
            ->where('number', $lesson_number)
            ->first();
        $lessons = $this->lessonRepo->getAcceptedLessons($course);

        return view("Front::lesson", compact('course', 'lesson', 'lessons'));
    }
}
