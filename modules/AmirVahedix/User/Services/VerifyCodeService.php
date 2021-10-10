<?php

namespace AmirVahedix\User\Services;

class VerifyCodeService
{
    private static $prefix = 'verify_code_';

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
    public static function store ($user_id, $code) {
        cache()->set(
            self::$prefix . $user_id,
            $code,
            now()->addSeconds(config('auth.verification_code.timeout'))
        );
    }

    /**
     * Get stored verification code for specific user
     */
    public static function get ($user_id) {
        return cache()->get(self::$prefix . $user_id);
    }

    /**
     * Deletes verify code from cache (to be called after verify code is used)
     */
    public static function destroy ($user_id) {
        cache()->delete(self::$prefix . $user_id);
    }

    /**
     * Checks if verification code is correct for specific user
     */
    public static function check ($user_id, $code) {
        if ($code == self::get($user_id)) {
            self::destroy($user_id);
            return true;
        }

        return false;
    }
}
