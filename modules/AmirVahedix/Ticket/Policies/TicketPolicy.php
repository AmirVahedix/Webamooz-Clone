<?php


namespace AmirVahedix\Ticket\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Ticket\Models\Ticket;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    public function manage(User $user, Ticket $ticket)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_TICKETS)) return true;

        if ($ticket->user_id == $user->id) return true;

        return false;
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_TICKETS);
    }
}
