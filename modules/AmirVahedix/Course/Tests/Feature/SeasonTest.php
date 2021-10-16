<?php /** @noinspection PhpParamsInspection */


namespace AmirVahedix\Course\Tests\Feature;


use AmirVahedix\Authorization\Database\Seeders\AuthorizationTablesSeeder;
use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Category\Models\Category;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SeasonTest extends TestCase
{
    public function test_course_manager_users_can_see_course_details_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.details', $course->id))
            ->assertOk();
    }

    public function test_teacher_can_see_own_course_details_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->state(['teacher_id' => $user->id])->create();

        $this->actingAs($user)
            ->get(route('admin.courses.details', $course->id))
            ->assertOk();
    }

    public function test_super_admin_can_see_course_details_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.details', $course->id))
            ->assertOk();
    }

    public function test_teacher_can_not_see_other_course_details_page()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.details', $course->id))
            ->assertStatus(403);
    }

    public function test_not_permitted_user_can_not_see_course_details_page()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.details', $course->id))
            ->assertStatus(403);
    }

    public function test_course_manager_can_manage_seasons()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
        $course = Course::factory()->create();

        $this->SeasonResourceActions($user, $course);
    }

    public function test_super_admin_can_manage_seasons()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);
        $course = Course::factory()->create();

        $this->SeasonResourceActions($user, $course);
    }

    public function test_teacher_can_manage_seasons_of_own_course()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->state(['teacher_id' => $user->id])->create();

        $this->SeasonResourceActions($user, $course);
    }

    public function test_teacher_can_not_manage_seasons_of_other_courses()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->create();

        // Store
        $this->actingAs($user)
            ->post(
                route('admin.seasons.store', $course->id),
                Season::factory()->make()->toArray()
            )
            ->assertStatus(403);
        $this->assertDatabaseCount('seasons', 0);

        // Edit
        $season = Season::factory()->state(['course_id' => $course->id])->create();
        $this->actingAs($user)
            ->get(route('admin.seasons.edit', $season->id))
            ->assertStatus(403);
        $this->assertDatabaseCount('seasons', 1);

        // Update
        $new_season_data = Season::factory()->make()->toArray();
        $this->actingAs($user)
            ->patch(
                route('admin.seasons.update', $season->id),
                $new_season_data
            );
        $this->assertEquals(0, Season::where([
            'title' => $new_season_data['title'],
            'number' => $new_season_data['number'],
            'course_id' => $course->id,
            'user_id' => $user->id
        ])->count());

        // Delete
        $this->actingAs($user)
            ->delete(route('admin.seasons.destroy', $season->id))
            ->assertStatus(403);
        $this->assertDatabaseCount('seasons', 1);
        $this->assertDatabaseHas('seasons', Season::findOrFail($season->id)->toArray());
    }

    private function SeasonResourceActions($user, $course): void
    {
        // Store
        $this->actingAs($user)
            ->post(
                route('admin.seasons.store', $course->id),
                Season::factory()->make()->toArray()
            )
            ->assertRedirect(route('admin.courses.details', $course->id));
        $this->assertDatabaseCount('seasons', 1);

        // Edit
        $season = Season::first();
        $this->actingAs($user)
            ->get(route('admin.seasons.edit', $season->id))
            ->assertOk();

        // Update
        $new_season_data = Season::factory()->make()->toArray();
        $this->actingAs($user)
            ->patch(
                route('admin.seasons.update', $season->id),
                $new_season_data
            );
        $this->assertDatabaseCount('seasons', 1);
        $new_season = Season::where([
            'title' => $new_season_data['title'],
            'number' => $new_season_data['number'],
            'course_id' => $course->id,
            'user_id' => $user->id
        ])->first()->toArray();
        $this->assertDatabaseHas('seasons', $new_season);

        // Delete
        $this->actingAs($user)
            ->delete(route('admin.seasons.destroy', $season->id))
            ->assertRedirect(route('admin.courses.details', $course->id));
        $this->assertDatabaseCount('seasons', 0);
        $this->assertDatabaseMissing('seasons', $new_season);
    }

}
