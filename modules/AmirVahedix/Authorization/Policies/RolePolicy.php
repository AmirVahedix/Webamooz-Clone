<?php


namespace AmirVahedix\Authorization\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    public function manag_roles(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_AUTHORIZATION);
    }
}
