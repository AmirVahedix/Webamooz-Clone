<?php


namespace AmirVahedix\Payment\Policies;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Payment\Models\Settlement;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettlementPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
    }

    public function index(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_TEACH) ||
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS);
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_TEACH);
    }

    public function accept(User $user, Settlement $settlement)
    {
        return ($settlement->status === Settlement::STATUS_WAITING || $settlement->status === Settlement::STATUS_REJECTED)
            && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS);
    }

    public function reject(User $user, Settlement $settlement)
    {
        return $settlement->status === Settlement::STATUS_WAITING &&
            $user->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS);
    }

    public function cancel(User $user, Settlement $settlement)
    {
        return $settlement->status === Settlement::STATUS_WAITING &&
            $settlement->user_id == $user->id;
    }
}
