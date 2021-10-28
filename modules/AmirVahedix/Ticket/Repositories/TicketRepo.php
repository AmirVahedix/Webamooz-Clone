<?php


namespace AmirVahedix\Ticket\Repositories;


use AmirVahedix\Ticket\Models\Ticket;
use Illuminate\Http\Request;

class TicketRepo
{
    public function store(Request $request)
    {
        return Ticket::query()->create([
            'user_id' => auth()->id(),
            'title' => $request->get('title'),
        ]);
    }
}
