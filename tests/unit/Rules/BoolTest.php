<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Bool
 * @covers Respect\Validation\Exceptions\BoolException
 */
class BoolTest extends \PHPUnit_Framework_TestCase
{
    public function testBooleanValuesONLYShouldReturnTrue()
    {
        $validator = new Bool();
        $this->assertTrue($validator->validate(''));
        $this->assertTrue($validator->validate(true));
        $this->assertTrue($validator->validate(false));
        $this->assertTrue($validator->assert(true));
        $this->assertTrue($validator->assert(false));
        $this->assertTrue($validator->check(true));
        $this->assertTrue($validator->check(false));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\BoolException
     */
    public function testInvalidBooleanShouldRaiseException()
    {
        $validator = new Bool();
        $this->assertFalse($validator->check('foo'));
    }

    public function testInvalidBooleanValuesShouldReturnFalse()
    {
        $validator = new Bool();
        $this->assertFalse($validator->validate('foo'));
        $this->assertFalse($validator->validate(123123));
        $this->assertFalse($validator->validate(new \stdClass()));
        $this->assertFalse($validator->validate(array()));
        $this->assertFalse($validator->validate(1));
        $this->assertFalse($validator->validate(0));
        $this->assertFalse($validator->validate(null));
    }
}
