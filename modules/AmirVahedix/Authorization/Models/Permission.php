<?php


namespace AmirVahedix\Authorization\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';
    const PERMISSION_MANAGE_AUTHORIZATION = 'manage_authorization';
    const PERMISSION_MANAGE_COURSES = 'manage_courses';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_SUPER_ADMIN = 'super_admin';

    const permissions = [
        self::PERMISSION_MANAGE_AUTHORIZATION,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_TEACH,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_SUPER_ADMIN,
    ];
}
