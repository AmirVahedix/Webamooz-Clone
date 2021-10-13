<?php

namespace AmirVahedix\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::findOrCreate('manage_categories');
        Permission::findOrCreate('manage_authorization');
        Permission::findOrCreate('teach');

        Role::findOrCreate('teacher')->givePermissionTo(['teach']);
    }
}
