<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonRepo
{
    public function store(Course $course, Request $request)
    {
        return Lesson::create([
            'title' => $request->get('title'),
            'slug' => $request->get('slug')
                ? Str::slug($request->get('slug'))
                : Str::slug($request->get('title')),
            'duration' => $request->get('duration'),
            'number' => $request->get('number')
                ? $request->get('number')
                : Lesson::where('course_id', $course->id)->get()->pluck('number')->max() + 1 ?? 1,
            'description' => $request->get('description'),
            'season_id' => $request->get('season'),
            'course_id' => $course->id,
            'media_id' => $request->get('media_id'),
            'user_id' => auth()->id(),
            'free' => $request->get('free'),
        ]);
    }

    public function updateConfirmationStatus(Lesson $lesson, string $status)
    {
        return $lesson->update([
            'confirmation_status' => $status
        ]);
    }

    public function acceptAll(Course $course)
    {
        return $course->lessons()->update([
            'confirmation_status' => Lesson::CONFIRMATION_ACCEPTED
        ]);
    }

    public function paginate($course, $per_page = 25)
    {
        return Lesson::where('course_id', $course->id)
            ->orderBy('number')
            ->paginate($per_page);
    }

    public function getAcceptedLessons($course)
    {
        return Lesson::where('course_id', $course->id)
            ->where('confirmation_status', Lesson::CONFIRMATION_ACCEPTED)
            ->get();
    }
}
