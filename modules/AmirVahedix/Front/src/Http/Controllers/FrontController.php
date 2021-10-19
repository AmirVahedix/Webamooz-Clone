<?php


namespace AmirVahedix\Front\Http\Controllers;


use AmirVahedix\Course\Models\Course;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view('Front::single-course', compact('course'));
    }

    public function shortCourseLink($course_id)
    {
        $course = Course::findOrFail($course_id);
        return redirect()->route('courses.single', $course->slug);
    }
}
