<?php


namespace AmirVahedix\Category\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // region model config
    protected $table = 'categories';

    protected $fillable = ['title', 'slug', 'parent_id'];
    // endregion model config

    // region relations
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    // endregion relations
}
