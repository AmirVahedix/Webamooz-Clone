<?php


namespace AmirVahedix\User\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Authorization\Models\Role;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    public function manage_users(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS);
    }

    public function manage_user_roles(User $user)
    {
        return $user->hasAllPermissions([
            Permission::PERMISSION_MANAGE_USERS,
            Permission::PERMISSION_MANAGE_AUTHORIZATION
        ]);
    }
}
