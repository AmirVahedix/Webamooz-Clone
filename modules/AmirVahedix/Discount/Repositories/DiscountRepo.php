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

    private function getDiscountQuery($type, $discounts) {
        $discount = $discounts
            ->whereNull('code')
            ->where('expires_at', '>', now())
            ->where('type', $type)
            ->where(function ($query) {
                $query->whereNull('limit')->orWhere('limit', '>', 0);
            })
            ->orderBy('percent', 'desc')
            ->first();

        if ($discount) {
            if ($discount->limit) {
                return $discount->where('uses', '<', $discount->limit )->first();
            } else {
                return $discount;
            }
        } else {
            return null;
        }
    }

    public function getBiggestGlobalDiscount()
    {
        return $this->getDiscountQuery(Discount::TYPE_ALL, Discount::query());

    }

    public function getBiggestSpecialDiscount(Course $course)
    {
        return $this->getDiscountQuery(Discount::TYPE_SPECIAL, $course->discounts());
    }

    public function codeIsValid($code, $course)
    {
        return Discount::query()
            ->where('code', $code)
            ->where(function ($query) use ($course) {
                return $query->whereHas('courses', function ($query) use ($course) {
                    $query->where('discountable_id', $course->id);
                })->orWhereDoesntHave("courses");
            })
            ->first();
    }
}
