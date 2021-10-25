<?php


namespace AmirVahedix\Discount\Http\Controllers;


use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Discount\Http\Requests\StoreDiscountRequest;
use AmirVahedix\Discount\Repositories\DiscountRepo;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    private $courseRepo;
    private $discountRepo;

    public function __construct(CourseRepo $courseRepo, DiscountRepo $discountRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->discountRepo = $discountRepo;
    }

    public function index()
    {
        $courses = $this->courseRepo->index();
        $discounts = $this->discountRepo->paginate();
        return view('Discount::index', compact('courses', 'discounts'));
    }

    public function store(StoreDiscountRequest $request)
    {
        $this->discountRepo->store($request);

        toast('تخفیف باموفقیت ایجاد شد.', 'success');
        return back();
    }
}
