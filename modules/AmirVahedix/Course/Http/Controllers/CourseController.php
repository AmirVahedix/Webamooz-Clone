<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Category\Repositories\CategoryRepo;
use AmirVahedix\Course\Http\Requests\CreateCourseRequest;
use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Media\Services\MediaUploadService;
use AmirVahedix\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    private $userRepo;
    private $categoryRepo;
    private $courseRepo;

    public function __construct(UserRepo $userRepo, CategoryRepo $categoryRepo, CourseRepo $courseRepo)
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
        $this->courseRepo = $courseRepo;
    }

    public function index()
    {
        $courses = $this->courseRepo->index();
        return view('Course::index', compact('courses'));
    }

    public function create()
    {
        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Course::create', compact('teachers', 'categories'));
    }

    public function store(CreateCourseRequest $request)
    {
        $banner_id = MediaUploadService::upload($request->file('banner'))->id;
        $request->request->add([
            'banner_id' => $banner_id
        ]);

        $this->courseRepo->create($request);

        toast('دوره باموفقیت ایجاد شد.', 'success');
        return redirect()->route('admin.courses.index');
    }
}
