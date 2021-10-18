<?php /** @noinspection PhpParamsInspection */


namespace AmirVahedix\Course\Tests\Feature;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\User\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class LessonTest extends TestCase
{
    public function test_course_manage_can_manage_lessons()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
        $course = Course::factory()->create();
        $lesson = Lesson::factory()->state([
            'course_id' => $course->id,
            'season_id' => Season::factory()->state(['course_id' => $course->id])->create(),
            'file' => UploadedFile::fake()->image('test.png')
        ])->make();

        $this->actingAs($user);

        // create
        $this->get(route('admin.lessons.create', $course))
            ->assertOk();

        // store
        $this->post(route('admin.lessons.store', $course), $lesson->toArray())
            ->assertRedirect(route('admin.courses.details', $course));

        $created_lesson = Lesson::where([
            'title' => $lesson['title'],
            'course_id' => $lesson['course_id'],
        ])->first();

        $this->assertDatabaseCount('lessons', 1);
        $this->assertDatabaseHas('lessons', $created_lesson->toArray());

        // edit
        $this->get(route('admin.lessons.edit', [$course, $created_lesson]))
            ->assertOk();

        // update
        $this->patch(
            route('admin.lessons.update', [$course, $created_lesson]),
            Lesson::factory()->state([
                'file' => UploadedFile::fake()->image('test2.png'),
                'season_id' => $created_lesson->season_id,
                'course_id' => $created_lesson->course_id,
                'number' => 10,
            ])->make()->toArray()
        )->assertRedirect(route('admin.courses.details', $course->id));
        $this->assertDatabaseCount('lessons', 1);

    }
}
