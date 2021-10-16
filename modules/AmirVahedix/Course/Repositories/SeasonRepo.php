<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Models\Season;

class SeasonRepo
{
    public function create($request, $course_id)
    {
        return Season::create([
            'title' => $request->title,
            'number' => $request->number,
            'course_id' => $course_id,
            'user_id' => auth()->id()
        ]);
    }
}
