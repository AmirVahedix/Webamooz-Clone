<?php


namespace AmirVahedix\Course\Models;


use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // region constants
    const CONFIRMATION_WAITING = 'waiting';
    const CONFIRMATION_ACCEPTED = 'accepted';
    const CONFIRMATION_REJECTED = 'rejected';
    const confirmation_statuses = [self::CONFIRMATION_WAITING, self::CONFIRMATION_ACCEPTED, self::CONFIRMATION_REJECTED];

    const STATUS_OPEN = 'open';
    const STATUS_LOCK = 'lock';
    const statuses = [self::STATUS_OPEN, self::STATUS_LOCK];
    // endregion constants

    // region model config
    protected $table = 'lessons';

    protected $fillable = [
        'course_id',
        'season_id',
        'user_id',
        'media_id',
        'title',
        'slug',
        'duration',
        'priority',
        'free',
        'description',
        'confirmation_status',
        'status',
    ];
    // endregion model config
}

