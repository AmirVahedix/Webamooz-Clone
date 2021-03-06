<?php


namespace AmirVahedix\Authorization\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage_categories';
    const PERMISSION_MANAGE_AUTHORIZATION = 'manage_authorization';
    const PERMISSION_MANAGE_COURSES = 'manage_courses';
    const PERMISSION_MANAGE_OWN_COURSES = 'manage_own_courses';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_SUPER_ADMIN = 'super_admin';
    const PERMISSION_MANAGE_USERS = 'manage_users';
    const PERMISSION_MANAGE_PAYMENTS = 'manage_payments';
    const PERMISSION_MANAGE_DISCOUNTS = 'manage_discounts';
    const PERMISSION_MANAGE_TICKETS = 'manage_tickets';
    const PERMISSION_MANAGE_COMMENTS = 'manage_comments';

    const permissions = [
        self::PERMISSION_MANAGE_AUTHORIZATION,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_TEACH,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES,
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_PAYMENTS,
        self::PERMISSION_MANAGE_DISCOUNTS,
        self::PERMISSION_MANAGE_TICKETS,
        self::PERMISSION_MANAGE_COMMENTS
    ];
}
