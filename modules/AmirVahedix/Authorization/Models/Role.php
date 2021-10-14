<?php


namespace AmirVahedix\Authorization\Models;


class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_TEACHER = 'مدرس';
    const ROLE_SUPER_ADMIN = 'مدیر کل';
    const ROLE_SUPPOER = 'پشتیبان';

    const roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH,
            Permission::PERMISSION_MANAGE_OWN_COURSES,
        ],
        self::ROLE_SUPER_ADMIN => [
            Permission::PERMISSION_SUPER_ADMIN
        ],
        self::ROLE_SUPPOER => [
            Permission::PERMISSION_MANAGE_AUTHORIZATION,
            Permission::PERMISSION_MANAGE_USERS
        ]
    ];
}
