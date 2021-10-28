<?php

namespace AmirVahedix\Ticket\Models;

use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // region model config
    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'ticketable_id',
        'ticketable_type',
        'title',
        'status',
    ];
    // endregion model config

    // region relations
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // endregion relations
}
