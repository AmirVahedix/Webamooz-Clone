<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Category\Repositories\CategoryRepo;
use AmirVahedix\Course\Http\Requests\Course\CreateCourseRequest;
use AmirVahedix\Course\Http\Requests\Course\UpdateCourseRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Course\Repositories\LessonRepo;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\Payment\Repositories\PaymentRepo;
use AmirVahedix\Payment\Services\PaymentService;
use AmirVahedix\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    private $userRepo;
    private $categoryRepo;
    private $courseRepo;
    private $lessonRepo;

    public function __construct(LessonRepo $lessonRepo, UserRepo $userRepo, CategoryRepo $categoryRepo, CourseRepo $courseRepo)
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
        $this->courseRepo = $courseRepo;
        $this->lessonRepo = $lessonRepo;
    }

    public function index()
    {
        $this->authorize('manage_courses', Course::class);

        $courses = [];

        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            $courses = $this->courseRepo->index();
        } else if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)) {
            $courses = $this->courseRepo->indexOwnCourses();
        }

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

        $banner_id = MediaService::publicUpload($request->file('banner'))->id;
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
        $this->authorize('details', [Course::class, $course]);

        $lessons = $this->lessonRepo->paginate($course);
        return view('Course::details', compact('course', 'lessons'));
    }

    public function buy(Course $course)
    {
        if (!$this->courseCanBePurchased($course)) return back();

        if (!$this->userCanPurchaseCourse($course)) return back();

        $amount = 0;
        $payment = PaymentService::generate($amount, $course, auth()->user());
    }

    private function courseCanBePurchased(Course $course): bool
    {
        if ($course->type === Course::TYPE_FREE) {
            alert("عملیات ناموفق", "دوره‌های رایگاه قابل خریداری نیستند!", "error")->showConfirmButton('حله', '#46B2F0');
            return false;
        }
        if ($course->status === Course::STATUS_LOCKED) {
            alert("عملیات ناموفق", "دوره موردنظر قفل شده و فعلا قابل خریداری نیست.", "error")->showConfirmButton('حله', '#46B2F0');
            return false;
        }
        if ($course->confirmation_status !== Course::CONFIRMATION_ACCEPTED) {
            alert("عملیات ناموفق", "دوره موردنظر هنوز تایید نشده و قابل خریداری نیست!", "error")->showConfirmButton('حله', '#46B2F0');
            return false;
        }

        return true;
    }

    private function userCanPurchaseCourse(Course $course): bool
    {
        if ($course->teacher_id == auth()->id()){
            alert("عملیات ناموفق", "شما مدرس این دوره هستید.", "error")->showConfirmButton('حله', '#46B2F0');
            return false;
        }

        if (auth()->user()->hasAccessToCourse($course)) {
            alert("عملیات ناموفق", "شما به این دوره دسترسی دارید.", "error")->showConfirmButton('حله', '#46B2F0');
            return false;
        }

        return true;
    }
}
