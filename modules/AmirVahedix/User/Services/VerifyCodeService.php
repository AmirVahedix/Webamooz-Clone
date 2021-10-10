<?php

namespace AmirVahedix\User\Services;

class VerifyCodeService
{
    /**
     * Creates a new 6-digit verification code
     */
    public static function generate()
    {
        return random_int(100000, 999999);
    }

    /**
     * Stores verification code in cache for a specific user
     */
    public static function store ($user_id, $code, $expire_minutes) {
        cache()->set(
            "verify_code_$user_id",
            $code,
            now()->addMinutes($expire_minutes)
        );
    }
}
