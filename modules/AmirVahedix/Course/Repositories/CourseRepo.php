<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Http\Requests\Course\UpdateCourseRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Media\Services\MediaService;

class CourseRepo
{
    public function index($order = 'desc')
    {
        return Course::orderBy('created_at', $order)->get();
    }

    public function indexOwnCourses($order = 'desc')
    {
        return Course::where('teacher_id', auth()->id())->orderBy('created_at', $order)->get();
    }

    public function latest()
    {
        return Course::where('confirmation_status', Course::CONFIRMATION_ACCEPTED)
            ->latest()->take(8)->get();
    }


    public function create($request)
    {
        return Course::create($request->all());
    }

    public function update(Course $course, UpdateCourseRequest $request)
    {
        if ($request->has('banner')) {
            if ($course->banner) $course->banner->delete();
            $banner_id = MediaService::publicUpload($request->file('banner'))->id;
            $request->request->add(['banner_id' => $banner_id]);
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }

        return $course->update($request->all());
    }

    public function updateConfirmationStatus(Course $course, string $status): bool
    {
        return $course->update([
            'confirmation_status' => $status
        ]);
    }

    public function getDuration($course_id)
    {
        return Lesson::where('course_id', $course_id)
            ->where('confirmation_status', Lesson::CONFIRMATION_ACCEPTED)
            ->sum('duration');
    }
}
