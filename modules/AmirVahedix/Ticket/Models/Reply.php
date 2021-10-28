<?php


namespace AmirVahedix\Ticket\Models;


use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    // region model config
    protected $table = 'ticket_replies';

    protected $fillable = [
        'user_id',
        'ticket_id',
        'media_id',
        'body',
    ];
    // endregion model config

    // region relations
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // endregion relations
}
