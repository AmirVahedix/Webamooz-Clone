<?php /** @noinspection PhpParamsInspection */


namespace AmirVahedix\Category\Tests\Feature;


use AmirVahedix\Authorization\Database\Seeders\AuthorizationTablesSeeder;
use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Category\Models\Category;
use AmirVahedix\User\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_non_authenticated_user_can_not_see_categories_page()
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_non_verified_user_can_not_see_categories_page()
    {
        $user = User::factory()->unverified()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_not_perform_any_action_on_categories_without_manage_categories_permission()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $category = Category::factory()->create();
        $category_data = Category::factory()->make()->toArray();
        $category_data['title'] = 'test';

        $this->actingAs($user)->get(route('admin.categories.index'))->assertStatus(403);
        $this->actingAs($user)->post(route('admin.categories.store'), $category_data)->assertStatus(403);
        $this->actingAs($user)->get(route('admin.categories.edit', $category->id))->assertStatus(403);
        $this->actingAs($user)->patch(route('admin.categories.update', $category->id), $category_data)->assertStatus(403);
        $this->actingAs($user)->delete(route('admin.categories.destroy', $category->id))->assertStatus(403);
    }

    public function test_user_see_category_pages_with_manage_categories_permission()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);

        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertOk();
    }

    public function test_user_see_category_pages_with_super_admin_permission()
    {
        $this->seed(AuthorizationTablesSeeder::class);
        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_SUPER_ADMIN);

        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertOk();
    }

    public function test_user_can_create_category()
    {
        $this->seed(AuthorizationTablesSeeder::class);

        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
        $category = Category::factory()->make()->toArray();

        $this->actingAs($user)
            ->post(route('admin.categories.store'), $category);

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_user_can_see_edit_category_page()
    {
        $this->seed(AuthorizationTablesSeeder::class);

        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.categories.edit', $category->id));

        $response->assertOk();
    }

    public function test_user_can_update_category()
    {
        $this->seed(AuthorizationTablesSeeder::class);

        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
        $category = Category::factory()->create();
        $new_category = Category::factory()->make();

        $response = $this->actingAs($user)
            ->patch(route('admin.categories.update', $category->id), [
                'title' => $new_category->title,
                'slug' => $new_category->slug,
                'parent_id' => null
            ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', $new_category->toArray());
    }

    public function test_user_can_delete_category()
    {
        $this->seed(AuthorizationTablesSeeder::class);

        $user = User::factory()->verified()->create();
        $user->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.categories.destroy', $category->id));

        $response->assertRedirect();
        $this->assertDatabaseCount('categories', 0);
    }
}
