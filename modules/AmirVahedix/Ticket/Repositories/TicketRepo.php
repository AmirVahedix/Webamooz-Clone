<?php


namespace AmirVahedix\Ticket\Repositories;


use AmirVahedix\Ticket\Models\Ticket;
use Illuminate\Http\Request;

class TicketRepo
{
    public function paginate($per_page = 25)
    {
        return Ticket::query()->latest()->paginate($per_page);
    }

    public function paginateForUser($user_id, $per_page = null)
    {
        return Ticket::query()->where('user_id', $user_id)
            ->latest()
            ->paginate($per_page);
    }

    public function store(Request $request)
    {
        return Ticket::query()->create([
            'user_id' => auth()->id(),
            'title' => $request->get('title'),
        ]);
    }
}
