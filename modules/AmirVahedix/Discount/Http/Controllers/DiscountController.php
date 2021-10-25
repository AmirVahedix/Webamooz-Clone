<?php


namespace AmirVahedix\Discount\Http\Controllers;


use AmirVahedix\Course\Repositories\CourseRepo;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    private $courseRepo;

    public function __construct(CourseRepo $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    public function index()
    {
        $courses = $this->courseRepo->index();
        return view('Discount::index', compact('courses'));
    }
}
