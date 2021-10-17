<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Course\Http\Requests\Lesson\StoreLessonRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Course\Repositories\LessonRepo;
use AmirVahedix\Course\Repositories\SeasonRepo;
use AmirVahedix\Media\Services\MediaService;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    private $seasonRepo;
    private $lessonRepo;

    public function __construct(SeasonRepo $seasonRepo, LessonRepo $lessonRepo)
    {
        $this->seasonRepo = $seasonRepo;
        $this->lessonRepo = $lessonRepo;
    }

    public function create(Course $course)
    {
        $seasons = $this->seasonRepo->getCourseSeasons($course);
        return view('Course::lessons.create', compact('seasons', 'course'));
    }

    public function store(StoreLessonRequest $request, Course $course)
    {
        $media = MediaService::upload($request->file('file'));
        $request->request->add([ 'media_id' => $media->id ]);

        $this->lessonRepo->store($course, $request);

        toast('درس باموفقیت ایجاد شد.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }
}
