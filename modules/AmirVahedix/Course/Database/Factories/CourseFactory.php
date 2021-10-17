<?php


namespace AmirVahedix\Course\Database\Factories;


use AmirVahedix\Category\Models\Category;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->paragraph(1),
            'slug' => $this->faker->slug,
            'priority' => null,
            'price' => $this->faker->numberBetween(10000, 100000),
            'percent' => $this->faker->numberBetween(1, 100),
            'teacher_id' => User::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
            'banner_id' => MediaService::publicUpload(UploadedFile::fake()->image('test.png'))->id,
            'type' => $this->faker->randomElement(Course::types),
            'status' => $this->faker->randomElement(Course::statuses),
            'confirmation_status' => $this->faker->randomElement(Course::confirmation_statuses),
            'description' => $this->faker->text,
        ];
    }
}
