<?php

namespace AmirVahedix\Discount\Models;

use AmirVahedix\Course\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    // region model config
    protected $table = 'discounts';

    protected $fillable = [
        'user_id',
        'percent',
        'limit',
        'expires_at',
        'link',
        'description',
        'uses',
    ];
    // endregion model config

    // region relations
    public function courses()
    {
        return $this->morphedByMany(Course::class, 'discountable');
    }
    // endregion relations
}
