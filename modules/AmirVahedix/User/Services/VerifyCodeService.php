<?php

namespace AmirVahedix\User\Services;

class VerifyCodeService
{
    public static function generate()
    {
        return random_int(100000, 999999);
    }

    public static function store ($user_id, $code, $expire_minutes) {
        cache()->set(
            "verify_code_$user_id",
            $code,
            now()->addMinutes($expire_minutes)
        );
    }
}
