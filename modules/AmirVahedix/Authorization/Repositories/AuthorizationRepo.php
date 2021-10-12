<?php


namespace AmirVahedix\Authorization\Repositories;


use Spatie\Permission\Models\Role;

class AuthorizationRepo
{
    public function createRole($name, $permissions)
    {
        $role = Role::create([
            'name' => $name
        ]);
        $role->syncPermissions($permissions);

        return $role;
    }
}
