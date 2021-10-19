<?php


namespace AmirVahedix\Course\Models;


use AmirVahedix\Course\Database\Factories\LessonFactory;
use AmirVahedix\Media\Models\Media;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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

    public static function factory()
    {
        return new LessonFactory;
    }
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

    // region custom attributes
    public function getFormattedDurationAttribute()
    {
        $H = ($this->duration / 60) < 10
            ? "0" . round($this->duration / 60)
            : round($this->duration / 60);
        $M = ($this->duration % 60) < 10
            ? "0" . ($this->duration % 60)
            : $this->duration % 60;
        $S = "00";

        if ($H == "00") return "$M:$S";

        return "$H:$M:$S";
    }
    // endregion  custom attributes

    // region custom methods
    public function downloadLink()
    {
        return URL::temporarySignedRoute(
            'media.download',
            now()->addDay(),
            [ 'media' => $this->media_id ]
        );
    }
    // endregion custom methods
}

