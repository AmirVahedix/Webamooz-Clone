<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Models\Course;

class CourseRepo
{
    public function index($order = 'desc')
    {
        return Course::orderBy('created_at', $order)->get();
    }

    public function create($request)
    {
        return Course::create($request->all());
    }
}
