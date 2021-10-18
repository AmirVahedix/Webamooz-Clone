<?php


namespace AmirVahedix\Course\Models;


use AmirVahedix\Course\Database\Factories\CourseFactory;
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

    public function categroy()
    {
        return $this->belongsTo(User::class, 'category_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
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
    // endregion custom attributes
}
