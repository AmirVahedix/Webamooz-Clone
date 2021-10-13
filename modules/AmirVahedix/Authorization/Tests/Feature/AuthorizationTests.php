<?php /** @noinspection PhpParamsInspection */


namespace AmirVahedix\Authorization\Tests\Feature;


use AmirVahedix\User\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthorizationTests extends TestCase
{
    public function test_non_authenticated_user_can_not_see_authorization_pages()
    {
        $role = Role::create([ 'name' => 'test' ]);

        $this->get(route('admin.authorization.index'))
            ->assertRedirect(route('login'));
        $this->get(route('admin.authorization.edit', $role->id))
            ->assertRedirect(route('login'));
    }

    public function test_non_verified_user_can_not_see_authorization_pages()
    {
        $user = User::factory()->create();
        $role = Role::create([ 'name' => 'test' ]);

        $this->actingAs($user)
            ->get(route('admin.authorization.index'))
            ->assertRedirect(route('verification.notice'));

        $this->actingAs($user)
            ->get(route('admin.authorization.edit', $role->id))
            ->assertRedirect(route('verification.notice'));
    }

    public function test_non_authenticated_and_verified_user_can_not_see_authorization_pages()
    {
        $user = User::factory()->verified()->create();
        $role = Role::create([ 'name' => 'test' ]);

        $this->actingAs($user)
            ->get(route('admin.authorization.index'))
            ->assertOk();

        $this->actingAs($user)
            ->get(route('admin.authorization.edit', $role->id))
            ->assertOk();
    }

    public function test_user_can_create_role()
    {
        $user = User::factory()->verified()->create();
        $permission = Permission::create(['name' => 'test_permission']);

        $this->actingAs($user)
            ->post(route('admin.authorization.store'), [
                'name' => 'test',
                'permissions' => [$permission->id]
            ])
            ->assertRedirect();

        $this->assertDatabaseCount('roles', 1);
    }

    public function test_user_can_edit_role()
    {
        $user = User::factory()->verified()->create();
        $role = Role::create([ 'name' => 'test' ]);
        $permission = Permission::create(['name' => 'test_updated_permission']);

        $response = $this
            ->actingAs($user)
            ->patch(route('admin.authorization.edit', $role->id), [
                'name' => 'updated_role',
                'permissions' => [
                    $permission->id
                ]
            ]);

        $response->assertRedirect(route('admin.authorization.index'));
        $this->assertDatabaseHas('roles', [ 'name' => 'updated_role' ]);
        $this->assertDatabaseMissing('roles', [ 'name' => $role->name ]);
        $this->assertDatabaseHas('role_has_permissions', [
            'role_id' => $role->id,
            'permission_id' => $permission->id
        ]);
    }

    public function test_user_can_delete_role()
    {
        $user = User::factory()->verified()->create();
        $role = Role::create([ 'name' => 'test' ]);
        $permission = Permission::create(['name' => 'test_updated_permission']);

        $response = $this
            ->actingAs($user)
            ->delete(route('admin.authorization.delete', $role->id));

        $response->assertRedirect(route('admin.authorization.index'));
        $this->assertDatabaseMissing('roles', [ 'name' => $role->name ]);
        $this->assertDatabaseMissing('role_has_permissions', [
            'role_id' => $role->id,
            'permission_id' => $permission->id
        ]);
        $this->assertDatabaseHas('permissions', [ 'name' => $permission->name ]);
    }
}
