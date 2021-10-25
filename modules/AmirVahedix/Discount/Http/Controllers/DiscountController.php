<?php


namespace AmirVahedix\Discount\Http\Controllers;


use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Discount\Http\Requests\StoreDiscountRequest;
use AmirVahedix\Discount\Models\Discount;
use AmirVahedix\Discount\Repositories\DiscountRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

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

    public function store(StoreDiscountRequest $request): RedirectResponse
    {
        $this->discountRepo->store($request);

        toast('تخفیف باموفقیت ایجاد شد.', 'success');
        return back();
    }

    public function delete(Discount $discount)
    {
        $discount->courses()->detach();
        $discount->delete();

        toast('کد تخفیف باموفقیت حذف شد.', 'success');
        return back();
    }
}
