<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;

class SeasonRepo
{
    public function findByIdAndCourseId(Season $season, Course $course)
    {
        return Season::where('course_id', $course->id)->where('id', $season)->first();
    }

    public function create($request, $course_id)
    {
        return Season::create([
            'title' => $request->title,
            'number' => $request->number,
            'course_id' => $course_id,
            'user_id' => auth()->id()
        ]);
    }

    public function getCourseSeasons($course)
    {
        return Season::where('course_id', $course->id)
            ->where('confirmation_status', Course::CONFIRMATION_ACCEPTED)
            ->orderBy('number')
            ->get();
    }
}
