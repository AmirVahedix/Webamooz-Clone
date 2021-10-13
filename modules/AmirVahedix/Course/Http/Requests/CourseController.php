<?php


namespace AmirVahedix\Course\Http\Requests;


use AmirVahedix\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return 'ok';
    }

    public function create()
    {
        $teachers = $this->userRepo->getTeachers();
        return view('Course::create', compact('teachers'));
    }
}
