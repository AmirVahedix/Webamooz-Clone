<?php


namespace AmirVahedix\Course\Repositories;


use AmirVahedix\Course\Http\Requests\UpdateCourseRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Media\Services\MediaService;

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

    public function update(Course $course, UpdateCourseRequest $request)
    {
        if ($request->has('banner')) {
            $course->banner->delete();
            $banner_id = MediaService::upload($request->file('banner'))->id;
            $request->request->add(['banner_id' => $banner_id]);
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }

        return $course->update($request->all());
    }
}
