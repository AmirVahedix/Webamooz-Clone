<?php


namespace AmirVahedix\Ticket\Repositories;


use AmirVahedix\Ticket\Models\Reply;
use AmirVahedix\Ticket\Models\Ticket;
use Illuminate\Http\Request;

class ReplyRepo
{
    public static function store($ticket_id, $body, $media_id = null)
    {
        return Reply::query()->create([
            'ticket_id' => $ticket_id,
            'user_id' => auth()->id(),
            'media_id' => $media_id,
            'body' => $body
        ]);
    }
}
