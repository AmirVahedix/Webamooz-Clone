<?php


namespace AmirVahedix\User\Services;


use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function changePassword($user, $new_password)
    {
        $user->update([
            'password' => Hash::make($new_password)
        ]);
    }
}
