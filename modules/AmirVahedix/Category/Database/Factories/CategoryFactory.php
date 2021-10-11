<?php


namespace AmirVahedix\Category\Database\Factories;


use AmirVahedix\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'parent_id' => null
        ];
    }
}
