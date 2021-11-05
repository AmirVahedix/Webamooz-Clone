<?php


namespace AmirVahedix\Comment\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COMMENTS);
    }
}
