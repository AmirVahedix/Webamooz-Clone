<?php

namespace AmirVahedix\User\Tests\Unit\Validation;

use AmirVahedix\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class PasswordValidation extends TestCase
{
    public function test_password_must_not_be_less_than_8_characters()
    {
        $result = (new ValidPassword())->passes('', '1234567');
        $this->assertEquals(0, $result);
    }

    public function test_password_must_include_words()
    {
        $result = (new ValidPassword())->passes('', '12345678');
        $this->assertEquals(0, $result);
    }

    public function test_password_must_include_digits()
    {
        $result = (new ValidPassword())->passes('', 'abcdefghijk');
        $this->assertEquals(0, $result);
    }

}
