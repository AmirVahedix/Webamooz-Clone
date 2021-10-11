<?php /** @noinspection PhpParamsInspection */


namespace AmirVahedix\Category\Tests\Feature;


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
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertRedirect(route('verification.notice'));
    }

    public function test_user_can_see_categories_page()
    {
        $user = User::factory()->verified()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.categories.index'));

        $response->assertOk();
    }

    public function test_user_can_create_category()
    {
        $user = User::factory()->verified()->create();
        $category = Category::factory()->make()->toArray();

        $this->actingAs($user)
            ->post(route('admin.categories.store'), $category);

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_user_can_see_edit_category_page()
    {
        $user = User::factory()->verified()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.categories.edit', $category->id));

        $response->assertOk();
    }

    public function test_user_can_update_category()
    {
        $user = User::factory()->verified()->create();
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
        $user = User::factory()->verified()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.categories.destroy', $category->id));

        $response->assertRedirect();
        $this->assertDatabaseCount('categories', 0);
    }
}
