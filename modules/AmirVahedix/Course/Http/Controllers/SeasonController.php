<?php

namespace AmirVahedix\Course\Http\Controllers;

use AmirVahedix\Course\Http\Requests\CreateSeasonRequest;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\Course\Repositories\SeasonRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    private $seasonRepo;

    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->seasonRepo = $seasonRepo;
    }

    public function store(CreateSeasonRequest $request, Course $course)
    {
        if (!$request->get('number')) {
            $max_number = Season::where('course_id', $course->id)->max('number');
            $request->request->add(['number' => $max_number+1]);
        }
        $this->seasonRepo->create($request, $course->id);

        toast('سرفصل باموفقیت ایجاد شد.', 'success');
        return back();
    }
}
