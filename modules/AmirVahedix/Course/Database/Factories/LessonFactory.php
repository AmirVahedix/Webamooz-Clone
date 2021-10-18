<?php


namespace AmirVahedix\Course\Database\Factories;


use AmirVahedix\Category\Models\Category;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use League\CommonMark\Extension\CommonMark\Node\Block\ThematicBreak;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        $course = Course::factory()->create();
        return [
            'title' => $this->faker->paragraph(1),
            'slug' => $this->faker->slug,
            'media_id' => MediaService::publicUpload(UploadedFile::fake()->image('test.png'))->id,
            'user_id' => User::factory()->create(),
            'course_id' => $course->id,
            'season_id' => Season::factory()->state(['course_id' => $course->id])->create()->id,
            'status' => $this->faker->randomElement(Lesson::statuses),
            'confirmation_status' => $this->faker->randomElement(Lesson::confirmation_statuses),
            'description' => $this->faker->text,
            'free' => 0,
        ];
    }
}
