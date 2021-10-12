<?php


namespace AmirVahedix\Authorization\Repositories;


use Spatie\Permission\Models\Role;

class AuthorizationRepo
{
    public function createRole($name, $permissions)
    {
        $role = Role::create([ 'name' => $name ]);
        $role->syncPermissions($permissions);

        return $role;
    }

    public function update($role, $name, $permissions)
    {
        $role->update([ 'name' => $name ]);
        $role->syncPermissions($permissions);

        return $role;
    }
}
