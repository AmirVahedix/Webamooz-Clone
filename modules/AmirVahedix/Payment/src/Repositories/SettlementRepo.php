<?php


namespace AmirVahedix\Payment\Repositories;


use AmirVahedix\Payment\Models\Settlement;

class SettlementRepo
{
    public function paginate($user_id = null, $status = null, $per_page = 25)
    {
        $query = Settlement::query();

        if ($user_id) $query = $query->where('user_id', $user_id);
        if ($status) $query = $query->where('status', $status);

        return $query->paginate($per_page);
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

    public function updateStatus(Settlement $settlement, string $status): bool
    {
        return $settlement->update([ 'status' => $status ]);
    }
}
