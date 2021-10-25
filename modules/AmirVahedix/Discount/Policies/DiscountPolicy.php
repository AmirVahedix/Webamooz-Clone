<?php


namespace AmirVahedix\Discount\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    public function manage(User $user): bool
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_DISCOUNTS);
    }
}
