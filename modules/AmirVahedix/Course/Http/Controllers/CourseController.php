<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Category\Repositories\CategoryRepo;
use AmirVahedix\Course\Http\Requests\CreateCourseRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

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

    public function store(CreateCourseRequest $request): RedirectResponse
    {
        $banner_id = MediaService::upload($request->file('banner'))->id;
        $request->request->add([
            'banner_id' => $banner_id
        ]);

        $this->courseRepo->create($request);

        toast('دوره باموفقیت ایجاد شد.', 'success');
        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Course::edit', compact('course', 'teachers', 'categories'));
    }

    public function delete(Course $course): RedirectResponse
    {
        if ($course->banner) {
            $course->banner->delete();
        }
        $course->delete();

        toast('دوره باموفقیت حذف شد.', 'success');
        return back();
    }
}
