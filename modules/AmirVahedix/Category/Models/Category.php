<?php


namespace AmirVahedix\Category\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // region model config
    protected $table = 'categories';

    protected $fillable = ['title', 'slug', 'parent_id'];
    // endregion model config
}
