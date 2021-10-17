<?php /** @noinspection PhpParamsInspection */


namespace AmirVahedix\Course\Tests\Feature;


use AmirVahedix\Authorization\Database\Seeders\AuthorizationTablesSeeder;
use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Category\Models\Category;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Models\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CourseTest extends TestCase
{
    public function test_permitted_user_can_see_courses_index()
    {
        $user = $this->CreatePermittedUser();

        $this->actingAs($user)
            ->get(route('admin.courses.index'))
            ->assertOk();
    }

    public function test_normal_user_can_not_see_courses_index()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.index'))
            ->assertStatus(403);
    }

    public function test_permitted_user_can_create_course()
    {
        $user = $this->CreatePermittedUser();
        $user->givePermissionTo(Permission::PERMISSION_TEACH);
        $course_data = Course::factory()->make()->toArray();
        $course_data['teacher_id'] = $user->id;
        $course_data['banner'] = UploadedFile::fake()->image('test.png');


        $this->actingAs($user)
            ->get(route('admin.courses.create'))
            ->assertOk();

        $this->actingAs($user)
            ->post(route('admin.courses.store'), $course_data)
            ->assertRedirect(route('admin.courses.index'));

        $this->assertDatabaseCount('courses', 1);
    }

    public function test_normal_user_can_not_create_course()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_TEACH);
        $course_data = Course::factory()->make()->toArray();
        $course_data['teacher_id'] = $user->id;
        $course_data['banner'] = UploadedFile::fake()->image('test.png');

        $this->actingAs($user)
            ->get(route('admin.courses.create'))
            ->assertStatus(403);

        $this->actingAs($user)
            ->post(route('admin.courses.store'), $course_data)
            ->assertStatus(403);

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_permitted_user_can_edit_course()
    {
        $user = $this->CreatePermittedUser();
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.edit', $course->id))->assertOk();
    }

    public function test_teacher_can_edit_own_course()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->state(['teacher_id' => $user->id])->create();

        $this->actingAs($user)
            ->get(route('admin.courses.edit', $course->id))
            ->assertOk();
    }

    public function test_teacher_can_not_edit_other_course()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.edit', $course->id))
            ->assertStatus(403);
    }

    public function test_normal_user_can_not_edit_course()
    {
        $user = $this->CreateNormalUser();
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.courses.edit', $course->id))
            ->assertStatus(403);
    }

    public function test_permitted_user_can_update_course()
    {
        $user = $this->CreatePermittedUser();
        $user->givePermissionTo(Permission::PERMISSION_TEACH);
        $course = Course::factory()->create();
        $new_data = Course::factory()->make()->toArray();

        $this->actingAs($user)
            ->get(route('admin.courses.update', $course->id), $new_data)
            ->assertOk();
    }

    public function test_teacher_can_update_own_course()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->state(['teacher_id' => $user->id])->create();
        $new_data = Course::factory()->make()->toArray();
        unset($new_data['teacher_id']);

        $this->actingAs($user)
            ->get(route('admin.courses.update', $course->id), $new_data)
            ->assertOk();
    }

    public function test_teacher_can_not_update_other_course()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->create();
        $new_data = Course::factory()->make()->toArray();

        $this->actingAs($user)
            ->get(route('admin.courses.update', $course->id), $new_data)
            ->assertStatus(403);
    }

    public function test_normal_user_can_not_update_course()
    {
        $user = $this->CreateNormalUser();
        $course = Course::factory()->create();
        $new_data = Course::factory()->make()->toArray();

        $this->actingAs($user)
            ->get(route('admin.courses.update', $course->id), $new_data)
            ->assertStatus(403);
    }

    public function test_permitted_user_can_delete_course()
    {
        $user = $this->CreatePermittedUser();
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.courses.delete', $course->id))
            ->assertRedirect(route('admin.courses.index'));

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_normal_user_can_not_delete_course()
    {
        $user = $this->CreateNormalUser();
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.courses.delete', $course->id))
            ->assertStatus(403);

        $this->assertDatabaseCount('courses', 1);
    }

    public function test_teacher_user_can_not_delete_courses()
    {
        $user = $this->CreateNormalUser();
        $user->givePermissionTo(Permission::PERMISSION_TEACH);
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.courses.delete', $course->id))
            ->assertStatus(403);

        $this->assertDatabaseCount('courses', 1);
    }

    public function test_teacher_user_can_not_delete_own_courses()
    {
        $user = $this->CreateNormalUser();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->create();

        $this->actingAs($user)
            ->delete(route('admin.courses.delete', $course->id))
            ->assertStatus(403);

        $this->assertDatabaseCount('courses', 1);
    }


    public function test_permitted_user_can_confirm_or_reject_course()
    {
        $user = $this->CreatePermittedUser();
        $course = Course::factory()->state(['confirmation_status' => 'waiting'])->create();

        $resposne = $this->actingAs($user)
            ->get(route('admin.courses.accept', $course->id))
            ->assertRedirect(route('admin.courses.index'));
        $this->assertEquals(Course::CONFIRMATION_ACCEPTED, Course::find($course->id)->confirmation_status);

        $this->actingAs($user)
            ->get(route('admin.courses.reject', $course->id))
            ->assertRedirect(route('admin.courses.index'));
        $this->assertEquals(Course::CONFIRMATION_REJECTED, Course::find($course->id)->confirmation_status);
    }

    public function test_normal_user_can_not_confirm_or_reject_course()
    {
        $user = $this->CreateNormalUser();
        $course = Course::factory()->state(['confirmation_status' => 'waiting'])->create();

        $this->actingAs($user)
            ->get(route('admin.courses.accept', $course->id))
            ->assertStatus(403);
        $this->assertEquals(Course::CONFIRMATION_PENDING, $course->confirmation_status);

        $this->actingAs($user)
            ->get(route('admin.courses.reject', $course->id))
            ->assertStatus(403);
        $this->assertEquals(Course::CONFIRMATION_PENDING, $course->confirmation_status);
    }

    public function test_teacher_user_can_not_confirm_or_reject_courses()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->state(['confirmation_status' => 'waiting'])->create();

        $this->actingAs($user)
            ->get(route('admin.courses.accept', $course->id))
            ->assertStatus(403);
        $this->assertEquals(Course::CONFIRMATION_PENDING, $course->confirmation_status);

        $this->actingAs($user)
            ->get(route('admin.courses.reject', $course->id))
            ->assertStatus(403);
        $this->assertEquals(Course::CONFIRMATION_PENDING, $course->confirmation_status);
    }

    public function test_teacher_user_can_not_confirm_or_reject_own_courses()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
        $course = Course::factory()->state([
            'confirmation_status' => 'waiting',
            'teacher_id' => $user->id
        ])->create();

        $this->actingAs($user)
            ->get(route('admin.courses.accept', $course->id))
            ->assertStatus(403);
        $this->assertEquals(Course::CONFIRMATION_PENDING, $course->confirmation_status);

        $this->actingAs($user)
            ->get(route('admin.courses.reject', $course->id))
            ->assertStatus(403);
        $this->assertEquals(Course::CONFIRMATION_PENDING, $course->confirmation_status);
    }

    private function CreatePermittedUser()
    {
        $user = User::factory()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
        return $user;
    }

    private function CreateNormalUser()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        return $user;
    }
}
