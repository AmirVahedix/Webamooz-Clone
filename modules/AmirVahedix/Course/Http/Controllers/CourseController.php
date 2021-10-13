<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Category\Repositories\CategoryRepo;
use AmirVahedix\Course\Http\Requests\CreateCourseRequest;
use AmirVahedix\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    private $userRepo;
    private $categoryRepo;

    public function __construct(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        return 'ok';
    }

    public function create()
    {
        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Course::create', compact('teachers', 'categories'));
    }

    public function store(CreateCourseRequest $request)
    {
        dd($request->validated());
    }
}
