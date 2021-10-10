<?php /** @noinspection PhpUndefinedMethodInspection */


namespace AmirVahedix\User\Repositories;


use AmirVahedix\User\Models\User;

class UserRepo
{
    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function findByEmail($email)
    {
        return User::whereEmail($email)->first();
    }
}
