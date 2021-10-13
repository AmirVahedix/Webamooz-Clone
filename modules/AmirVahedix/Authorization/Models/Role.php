<?php


namespace AmirVahedix\Authorization\Models;


class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_TEACHER = 'teacher';

    const roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ]
    ];
}
