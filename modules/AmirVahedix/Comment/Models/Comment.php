<?php


namespace AmirVahedix\Comment\Models;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // region constants
    const STATUS_WAITING = 'waiting';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    const statuses = [self::STATUS_WAITING, self::STATUS_APPROVED, self::STATUS_REJECTED];
    // endregion constants

    // region model config
    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'parent_id',
        'commentable_id',
        'commentable_type',
        'body',
        'status',
    ];
    // endregion model config
}
