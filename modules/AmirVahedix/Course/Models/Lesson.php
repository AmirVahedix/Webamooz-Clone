<?php


namespace AmirVahedix\Course\Models;


use AmirVahedix\Media\Models\Media;
use AmirVahedix\User\Models\User;
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
        'number',
        'free',
        'description',
        'confirmation_status',
        'status',
    ];
    // endregion model config

    // region relations
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    // endregion relations
}

