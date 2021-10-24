<?php

namespace AmirVahedix\Payment\Models;

use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;

    // region constants
    const STATUS_SETTLED = 'settled';
    const STATUS_WAITING = 'waiting';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELED = 'canceled';

    const statuses = [self::STATUS_SETTLED, self::STATUS_WAITING, self::STATUS_REJECTED, self::STATUS_CANCELED];
    // endregion constants

    // region model config
    protected $table = 'settlements';

    protected $fillable = [
        'user_id',
        'transaction_id',
        'from',
        'to',
        'amount',
        'settled_at',
        'status',
    ];

    protected $casts = [
        "to" => "json",
        "from" => "json"
    ];
    // endregion model config

    // region relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // endregion relations
}
