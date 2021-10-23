<?php


namespace AmirVahedix\Payment\Repositories;


use AmirVahedix\Payment\Models\Settlement;

class SettlementRepo
{
    public function paginate($user_id, $per_page = 25)
    {
        return Settlement::query()->where('user_id', $user_id)->paginate($per_page);
    }

    public function store($request)
    {
        return Settlement::query()->create([
            'user_id' => auth()->id(),
            'to' => [
                'name' => $request->get('name'),
                'cart' => $request->get('cart'),
            ],
            'amount' => $request->get('amount'),
        ]);
    }
}
