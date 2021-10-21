<?php


namespace AmirVahedix\Payment\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
    }

    public function manage(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS);
    }
}
