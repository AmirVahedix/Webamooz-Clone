<?php


namespace AmirVahedix\Authorization\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';
    const PERMISSION_MANAGE_AUTHORIZATION = 'manage_authorization';
    const PERMISSION_TEACH = 'teach';

    const permissions = [
        self::PERMISSION_MANAGE_AUTHORIZATION,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_TEACH
    ];
}
