<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Category\Repositories\CategoryRepo;
use AmirVahedix\Course\Http\Requests\Course\CreateCourseRequest;
use AmirVahedix\Course\Http\Requests\Course\UpdateCourseRequest;
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
        $this->authorize('manage_courses', Course::class);

        $courses = $this->courseRepo->index();
        return view('Course::index', compact('courses'));
    }

    public function create()
    {
        $this->authorize('create_course', Course::class);

        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Course::create', compact('teachers', 'categories'));
    }

    public function store(CreateCourseRequest $request): RedirectResponse
    {
        $this->authorize('create_course', Course::class);

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
        $this->authorize('edit', [Course::class, $course]);

        $teachers = $this->userRepo->getTeachers();
        $categories = $this->categoryRepo->all();
        return view('Course::edit', compact('course', 'teachers', 'categories'));
    }

    public function update(Course $course, UpdateCourseRequest $request)
    {
        $this->authorize('edit', Course::class);

        $this->courseRepo->update($course, $request);

        toast('دوره باموفقیت ویرایش شد.', 'success');
        return redirect()->route('admin.courses.index');
    }

    public function delete(Course $course): RedirectResponse
    {
        $this->authorize('delete', Course::class);

        if ($course->banner) {
            $course->banner->delete();
        }
        $course->delete();

        toast('دوره باموفقیت حذف شد.', 'success');
        return redirect()->route('admin.courses.index');
    }

    public function accept(Course $course)
    {
        $this->authorize('confirm', Course::class);

        $this->courseRepo->updateConfirmationStatus($course, Course::CONFIRMATION_ACCEPTED);

        toast('وضعیت دوره باموفقیت اپدیت شد.', 'success');
        return redirect()->route('admin.courses.index');
    }

    public function reject(Course $course)
    {
        $this->authorize('confirm', Course::class);

        $this->courseRepo->updateConfirmationStatus($course, Course::CONFIRMATION_REJECTED);

        toast('وضعیت دوره باموفقیت اپدیت شد.', 'success');
        return redirect()->route('admin.courses.index');
    }

    public function details(Course $course)
    {
        return view('Course::details', compact('course'));
    }
}
