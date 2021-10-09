<?php

namespace AmirVahedix\User\Tests\Unit\Validation;

use AmirVahedix\User\Rules\ValidMobile;
use PHPUnit\Framework\TestCase;

class MobileValidationTest extends TestCase
{
    public function test_mobile_must_be_11_characters()
    {
        $mobile_10_chars = (new ValidMobile())->passes('', '0913063572');
        $mobile_11_chars = (new ValidMobile())->passes('', '09130635720');
        $mobile_12_chars = (new ValidMobile())->passes('', '091306357200');


        $this->assertEquals(0, $mobile_10_chars);
        $this->assertEquals(1, $mobile_11_chars);
        $this->assertEquals(0, $mobile_12_chars);
    }

    public function test_mobile_must_start_with_09 () {
        $result = (new ValidMobile())->passes('', '91306357200');

        $this->assertEquals(0, $result);
    }
}
