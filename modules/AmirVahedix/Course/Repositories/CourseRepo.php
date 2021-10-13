<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Models\Course;

class CourseRepo
{
    public function create($request)
    {
        return Course::create($request->all());
    }
}
