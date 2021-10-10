<?php

namespace AmirVahedix\User\Tests\Unit;

use AmirVahedix\User\Models\User;
use AmirVahedix\User\Rules\ValidMobile;
use AmirVahedix\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase
{
    public function test_generated_code_has_6_digits ()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code);
        $this->assertLessThanOrEqual(999999, $code);
        $this->assertGreaterThanOrEqual(100000, $code);
    }

    public function test_verification_code_is_stored_in_cache ()
    {
        $user = User::factory()->create();
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code, 5);

        $this->assertEquals($code, VerifyCodeService::get($user->id));
    }

    public function test_verification_code_is_expired_after_certain_minutes () {
        $user = User::factory()->create();
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code);

        $this->assertEquals($code, VerifyCodeService::get($user->id));
        $this->travel(6)->minutes();
        $this->assertNull(VerifyCodeService::get($user->id));
    }

    public function test_verification_code_is_deleted_after_successful_verification () {
        $user = User::factory()->create();
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code);

        $this->actingAs($user)
            ->post(
                route('verification.verify', $user->id),
                ['verify_code' => $code]
            );

        $this->assertNull(VerifyCodeService::get($user->id));
    }
}
