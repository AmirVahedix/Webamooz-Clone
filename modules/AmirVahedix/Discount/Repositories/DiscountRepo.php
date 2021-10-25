<?php


namespace AmirVahedix\Discount\Repositories;


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
}
