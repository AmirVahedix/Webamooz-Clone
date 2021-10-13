<?php


namespace AmirVahedix\Course\Models;


use AmirVahedix\Media\Models\Media;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // region constants
    const TYPE_FREE = 'free';
    const TYPE_PAID = 'paid';
    const types = [self::TYPE_FREE, self::TYPE_PAID];

    const STATUS_COMPLETED = 'completed';
    const STATUS_PENDING = 'pending';
    const STATUS_LOCKED = 'locked';
    const statuses = [self::STATUS_COMPLETED, self::STATUS_PENDING, self::STATUS_LOCKED];
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
        'description',
        'banner_id'
    ];
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
