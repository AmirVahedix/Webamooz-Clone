<?php


namespace AmirVahedix\Course\Http\Controllers;


use AmirVahedix\Course\Http\Requests\Lesson\StoreLessonRequest;
use AmirVahedix\Course\Http\Requests\Lesson\UpdateLessonRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Course\Repositories\LessonRepo;
use AmirVahedix\Course\Repositories\SeasonRepo;
use AmirVahedix\Media\Services\MediaService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $this->authorize('create', [Lesson::class, $course]);

        $seasons = $this->seasonRepo->getCourseSeasons($course);
        return view('Course::lessons.create', compact('seasons', 'course'));
    }

    public function store(StoreLessonRequest $request, Course $course)
    {
        $this->authorize('create', [Lesson::class, $course]);

        $media = MediaService::privateUpload($request->file('file'));
        $request->request->add([ 'media_id' => $media->id ]);

        $this->lessonRepo->store($course, $request);

        toast('درس باموفقیت ایجاد شد.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $this->authorize('edit', [Lesson::class, $lesson]);

        $seasons = $this->seasonRepo->getCourseSeasons($course);
        return view('Course::lessons.edit', compact('lesson', 'course', 'seasons'));
    }

    public function update(UpdateLessonRequest $request, Course $course, Lesson $lesson)
    {
        $this->authorize('edit', [Lesson::class, $lesson]);

        if ($request->hasFile('file')){
            if ($lesson->media) $lesson->media->delete();
            $media = MediaService::privateUpload($request->file('file'));
            $request->request->add(["media_id" => $media->id]);
        }
        $lesson->update($request->all());

        toast('درس باموفقیت ویرایش شد.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function delete(Course $course, Lesson $lesson)
    {
        $this->authorize('delete', [Lesson::class, $lesson]);

        if ($lesson->media)
            $lesson->media->delete();

        $lesson->delete();

        toast('درس باموفقیت حذف شد.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function multipleDelete(Course $course, Request $request)
    {
        $lessons = explode(',', $request->get('lessons'));

        $this->authorize('deleteMultiple', [Lesson::class, $course, $lessons]);

        foreach ($lessons as $id) {
            $lesson = Lesson::findOrFail($id);
            if ($lesson->media)
                $lesson->media->delete();
            $lesson->delete();
        }

        toast('دروس باموفقیت حذف شدند.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function accept(Course $course, Lesson $lesson)
    {
        $this->authorize('confirm', Lesson::class);

        $this->lessonRepo->updateConfirmationStatus($lesson, Lesson::CONFIRMATION_ACCEPTED);

        toast('جلسه باموفقیت تایید شدند.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function acceptAll(Course $course)
    {
        $this->authorize('confirm', Lesson::class);

        $this->lessonRepo->acceptAll($course);

        toast('همه جلسات تایید شدند.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function acceptMultiple(Course $course, Request $request)
    {
        $this->authorize('confirm', Lesson::class);

        $lessons = explode(',', $request->get('lessons'));
        foreach ($lessons as $lesson) {
            Lesson::findOrFail($lesson)->update([
                'confirmation_status' => Lesson::CONFIRMATION_ACCEPTED
            ]);
        }

        toast('جلسات انتخابی تایید شدند.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function reject(Course $course, Lesson $lesson)
    {
        $this->authorize('confirm', Lesson::class);

        $this->lessonRepo->updateConfirmationStatus($lesson, Lesson::CONFIRMATION_REJECTED);

        toast('جلسه باموفقیت رد شدند.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }

    public function rejectMultiple(Course $course, Request $request)
    {
        $this->authorize('confirm', Lesson::class);

        $lessons = explode(',', $request->get('lessons'));
        foreach ($lessons as $lesson) {
            Lesson::findOrFail($lesson)->update([
                'confirmation_status' => Lesson::CONFIRMATION_REJECTED
            ]);
        }

        toast('جلسات انتخابی رد شدند.', 'success');
        return redirect()->route('admin.courses.details', $course->id);
    }
}
