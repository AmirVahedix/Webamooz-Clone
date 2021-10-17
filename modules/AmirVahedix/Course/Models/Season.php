<?php

namespace AmirVahedix\Course\Models;

use AmirVahedix\Course\Database\Factories\SeasonFactory;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    // region model config
    protected $table = 'seasons';

    protected $fillable = [
        'course_id',
        'user_id',
        'title',
        'number',
        'confirmation_status',
    ];

    public static function factory()
    {
        return new SeasonFactory();
    }
    // endregion model config

    // region constants
    const CONFIRMATION_WAITING = 'waiting';
    const CONFIRMATION_ACCEPTED = 'accepted';
    const CONFIRMATION_REJECTED = 'rejected';

    const confirmation_statuses = [self::CONFIRMATION_WAITING, self::CONFIRMATION_ACCEPTED, self::CONFIRMATION_REJECTED];
    // endregion constants

    // region relations
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    // endregion relations
}
