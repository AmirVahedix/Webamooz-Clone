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
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1, $code, 5);

        $this->assertEquals($code, cache()->get("verify_code_1"));
    }

    public function test_verification_code_is_expired_after_5_minutes () {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1, $code, 5);

        $this->assertEquals($code, cache()->get("verify_code_1"));
        $this->travel(6)->minutes();
        $this->assertNull(cache()->get("verify_code_1"));
    }
}
