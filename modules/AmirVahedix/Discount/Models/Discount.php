<?php

namespace AmirVahedix\Discount\Models;

use AmirVahedix\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    // region constants
    const TYPE_ALL = 'all';
    const TYPE_SPECIAL = 'special';

    const types = [self::TYPE_ALL, self::TYPE_SPECIAL];
    // endregion constants

    // region model config
    protected $table = 'discounts';

    protected $fillable = [
        'user_id',
        'code',
        'percent',
        'limit',
        'expires_at',
        'link',
        'description',
        'uses',
    ];

    protected $casts = [
        'expires_at' => 'timestamp'
    ];
    // endregion model config

    // region relations
    public function courses()
    {
        return $this->morphedByMany(Course::class, 'discountable');
    }
    // endregion relations
}
