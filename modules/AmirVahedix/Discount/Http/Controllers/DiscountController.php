<?php


namespace AmirVahedix\Discount\Http\Controllers;


use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Discount\Http\Requests\StoreDiscountRequest;
use AmirVahedix\Discount\Http\Requests\UpdateDiscountRequest;
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
        $this->authorize('manage', Discount::class);

        $courses = $this->courseRepo->index();
        $discounts = $this->discountRepo->paginate();
        return view('Discount::index', compact('courses', 'discounts'));
    }

    public function store(StoreDiscountRequest $request): RedirectResponse
    {
        $this->authorize('manage', Discount::class);

        $this->discountRepo->store($request);

        toast('تخفیف باموفقیت ایجاد شد.', 'success');
        return back();
    }

    public function edit(Discount $discount)
    {
        $this->authorize('manage', Discount::class);

        $courses = $this->courseRepo->index();
        return view('Discount::edit', compact('discount', 'courses'));
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $this->authorize('manage', Discount::class);

        $this->discountRepo->update($discount, $request);

        toast('تخفیف باموفقیت ویرایش شد.', 'success');
        return redirect()->route('admin.discounts.index');
    }

    public function delete(Discount $discount): RedirectResponse
    {
        $this->authorize('manage', Discount::class);

        $discount->courses()->detach();
        $discount->delete();

        toast('کد تخفیف باموفقیت حذف شد.', 'success');
        return back();
    }
}
