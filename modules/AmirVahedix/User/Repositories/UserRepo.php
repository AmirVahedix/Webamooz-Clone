<?php /** @noinspection PhpUndefinedMethodInspection */


namespace AmirVahedix\User\Repositories;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\User\Models\User;

class UserRepo
{
    public function paginate($per_page = 25)
    {
        return User::latest()->paginate($per_page);
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function findByEmail($email)
    {
        return User::whereEmail($email)->first();
    }

    public function getTeachers()
    {
        return User::permission(Permission::PERMISSION_TEACH)->get();
    }
}
