<?php


namespace AmirVahedix\Comment\Models;

use AmirVahedix\User\Models\User;
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

    // region relations
    public function commentable ()
    {
        return $this->morphTo();
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function parent ()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function children ()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
    // endregion

    public function getStatusClassAttribute()
    {
        if ($this->status == self::STATUS_WAITING) return 'text-warning';
        if ($this->status == self::STATUS_REJECTED) return 'text-error';
        if ($this->status == self::STATUS_APPROVED) return 'text-success';
    }
}
