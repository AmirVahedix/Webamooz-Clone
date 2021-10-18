<?php


namespace AmirVahedix\Category\Models;


use AmirVahedix\Category\Database\Factories\CategoryFactory;
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

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    // endregion relations

    public static function factory(): CategoryFactory
    {
        return new CategoryFactory();
    }

}
