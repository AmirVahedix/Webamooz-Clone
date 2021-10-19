<?php


namespace AmirVahedix\Course\Models;


use AmirVahedix\Category\Models\Category;
use AmirVahedix\Course\Database\Factories\CourseFactory;
use AmirVahedix\Course\Repositories\CourseRepo;
use AmirVahedix\Media\Models\Media;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // region constants
    const TYPE_FREE = 'free';
    const TYPE_PAID = 'paid';
    const types = [self::TYPE_FREE, self::TYPE_PAID];

    const STATUS_COMPLETED = 'completed';
    const STATUS_PENDING = 'pending';
    const STATUS_LOCKED = 'locked';
    const statuses = [self::STATUS_COMPLETED, self::STATUS_PENDING, self::STATUS_LOCKED];

    const CONFIRMATION_ACCEPTED = 'accepted';
    const CONFIRMATION_PENDING = 'waiting';
    const CONFIRMATION_REJECTED = 'rejected';
    const confirmation_statuses = [self::CONFIRMATION_ACCEPTED, self::CONFIRMATION_PENDING, self::CONFIRMATION_REJECTED];
    // endregion constants

    // region modal config
    protected $table = 'courses';

    protected $fillable = [
        'teacher_id',
        'category_id',
        'title',
        'slug',
        'priority',
        'price',
        'percent',
        'type',
        'status',
        'confirmation_status',
        'description',
        'banner_id'
    ];

    public static function factory()
    {
        return new CourseFactory;
    }
    // endregion modal config

    // region relations
    public function banner()
    {
        return $this->belongsTo(Media::class, 'banner_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function students()
    {
        return $this->belongsToMany(
            User::class,
            'course_students',
            'course_id',
            'user_id'
        );
    }
    // endregion relations

    // region custom attributes
    public function getThumbAttribute()
    {
        if (!$this->banner) return null;

        $banners = (array) json_decode($this->banner->files);
        return '/storage/'. $banners[300];
    }

    public function getOriginalBannerAttribute()
    {
        if (!$this->banner) return null;

        $banners = (array) json_decode($this->banner->files);
        return '/storage/'. $banners['original'];
    }

    public function getFormattedDurationAttribute()
    {
        $duration = (new CourseRepo())->getDuration($this->id);
        $H = round($duration / 60) < 10 ? "0".round($duration / 60) : round($duration / 60);
        $M = ($duration % 60) < 10 ? "0".($duration % 60) : ($duration % 60);
        $S = "00";
        return "$H:$M:$S";
    }

    public function getLessonsCountAttribute()
    {
        return (new CourseRepo())->getLessonsCount($this->id);
    }
    // endregion custom attributes
}
