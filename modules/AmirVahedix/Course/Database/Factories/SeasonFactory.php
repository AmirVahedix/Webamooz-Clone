<?php


namespace AmirVahedix\Course\Database\Factories;


use AmirVahedix\Category\Models\Category;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;

class SeasonFactory extends Factory
{
    protected $model = Season::class;

    public function definition()
    {
        return [
            'title' => $this->faker->paragraph(1),
            'number' => $this->faker->randomNumber(),
            'confirmation_status' => $this->faker->randomElement(Season::confirmation_statuses),
            'course_id' => Course::factory()->create()->id,
            'user_id' => User::factory()->create()->id
        ];
    }
}
