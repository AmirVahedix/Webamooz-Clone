<?php


namespace AmirVahedix\Discount\Repositories;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Discount\Models\Discount;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class DiscountRepo
{
    public function paginate(): LengthAwarePaginator
    {
        return Discount::query()->latest()->paginate(25);
    }

    public function store(Request $request)
    {
        $expires_at = $request->get('expires_at')
            ? Jalalian::fromFormat("Y/m/d H:i", $request->get('expires_at'))->toCarbon()
            : null;

        $discount = Discount::query()->create([
            'user_id' => auth()->id(),
            'code' => $request->get('code'),
            'percent' => $request->get('percent'),
            'limit' => $request->get('limit'),
            'expires_at' => $expires_at,
            'type' => $request->get('type'),
            'link' => $request->get('link'),
            'description' => $request->get('description'),
        ]);

        if ($request->get('courses')) {
            $discount->courses()->sync($request->get('courses'));
        }
    }

    public function update(Discount $discount, Request $request)
    {
        $expires_at = $request->get('expires_at')
            ? Jalalian::fromFormat("Y/m/d H:i", $request->get('expires_at'))->toCarbon()
            : null;

        $discount->update([
            'user_id' => auth()->id(),
            'code' => $request->get('code'),
            'percent' => $request->get('percent'),
            'limit' => $request->get('limit'),
            'expires_at' => $expires_at,
            'type' => $request->get('type'),
            'link' => $request->get('link'),
            'description' => $request->get('description'),
        ]);

        if ($request->get('courses') && $request->get('type') === Discount::TYPE_SPECIAL) {
            $discount->courses()->sync($request->get('courses'));
        } else {
            $discount->courses()->detach();
        }
    }

    public function getBiggestGlobalDiscount()
    {
        $discount = Discount::query()
            ->where('expires_at', '>', now())
            ->where('type', Discount::TYPE_ALL)
            ->where(function ($query) {
                $query->whereNull('limit')->orWhere('limit', '>', 0);
            })
            ->orderBy('percent', 'desc')
            ->first();

        return $discount
            ? $discount->where('users', '<', $discount->limit)->first()
            : '';
    }

    public function getBiggestSpecialDiscount(Course $course)
    {
        $discount = $course
            ->discounts()
            ->where('expires_at', '>', now())
            ->where(function ($query) {
                $query->whereNull('limit')->orWhere('limit', '>', 0);
            })
            ->orderBy('percent', 'desc')
            ->first();

        return $discount
            ? $discount->where('uses', '<', $discount->limit)->first()
            : '';
    }
}
