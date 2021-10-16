<?php

namespace AmirVahedix\Course\Http\Controllers;

use AmirVahedix\Course\Http\Requests\Season\StoreSeasonRequest;
use AmirVahedix\Course\Http\Requests\Season\UpdateSeasonRequest;
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

    public function store(StoreSeasonRequest $request, Course $course)
    {
        $this->authorize('create', Season::class);

        if (!$request->get('number')) {
            $max_number = Season::where('course_id', $course->id)->max('number');
            $request->request->add(['number' => $max_number+1]);
        }
        $this->seasonRepo->create($request, $course->id);

        toast('سرفصل باموفقیت ایجاد شد.', 'success');
        return back();
    }

    public function edit(Season $season)
    {
        $this->authorize('edit', [Season::class, $season]);

        return view("Course::season.edit", compact('season'));
    }

    public function update(UpdateSeasonRequest $request, Season $season)
    {
        $this->authorize('edit', [Season::class, $season]);

        $season->update($request->validated());

        toast('سرفصل باموفقیت ایجاد شد.', 'success');
        return redirect()->route('admin.courses.details', $season->course->id);
    }

    public function delete(Season $season)
    {
        $this->authorize('delete', Season::class);

        $season->delete();

        toast('سرفصل باموفقیت حذف شد.', 'success');
        return back();
    }

    public function reject(Season $season)
    {
        $this->authorize('confirm', Season::class);

        $season->update([ 'confirmation_status' => Season::CONFIRMATION_REJECTED ]);

        toast('سرفصل باموفقیت رد شد.', 'success');
        return back();
    }

    public function accept(Season $season)
    {
        $this->authorize('confirm', Season::class);

        $season->update([ 'confirmation_status' => Season::CONFIRMATION_ACCEPTED ]);

        toast('سرفصل باموفقیت تایید شد.', 'success');
        return back();
    }
}
