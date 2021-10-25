<?php


namespace AmirVahedix\Discount\Repositories;


use AmirVahedix\Discount\Models\Discount;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class DiscountRepo
{
    public function store(Request $request)
    {
        $expires_at = Jalalian::fromFormat("Y/m/d H:i", $request->get('expires_at'))
            ->toCarbon();
        return Discount::query()->create([
            'user_id' => auth()->id(),
            'code' => $request->get('code'),
            'percent' => $request->get('percent'),
            'limit' => $request->get('limit'),
            'expires_at' => $expires_at,
            'link' => $request->get('link'),
            'description' => $request->get('description'),
        ]);
    }
}
