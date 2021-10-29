<?php

namespace AmirVahedix\Ticket\Models;

use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Ticket extends Model
{
    use HasFactory;

    // region constants
    const STATUS_WAITING = 'waiting';
    const STATUS_ANSWERED = 'answered';
    const STATUS_CLOSED = 'closed';

    const statuses = [self::STATUS_WAITING, self::STATUS_ANSWERED, self::STATUS_CLOSED];
    // endregion constants

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
