<?php


namespace AmirVahedix\Course\Models;


use AmirVahedix\Media\Models\Media;
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
        return $this->belongsTo(Media::class, 'banner_id', 'id');
    }
    // endregion relations
}
