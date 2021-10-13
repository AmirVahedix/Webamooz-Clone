<?php

namespace AmirVahedix\Authorization\Database\Seeders;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Authorization\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;

class AuthorizationTablesSeeder extends Seeder
{
    public function run()
    {
        foreach (Permission::permissions as $permission) {
            SpatiePermission::findOrCreate($permission);
        }

        foreach (Role::roles as $role => $permissions) {
            SpatieRole::findOrCreate($role)
                ->givePermissionTo($permissions);
        }
    }
}
