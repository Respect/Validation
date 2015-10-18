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
 * @covers Respect\Validation\Rules\BoolType
 * @covers Respect\Validation\Exceptions\BoolTypeException
 */
class BoolTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testBooleanValuesONLYShouldReturnTrue()
    {
        $validator = new BoolType();
        $this->assertTrue($validator->__invoke(true));
        $this->assertTrue($validator->__invoke(false));
        $this->assertTrue($validator->assert(true));
        $this->assertTrue($validator->assert(false));
        $this->assertTrue($validator->check(true));
        $this->assertTrue($validator->check(false));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\BoolTypeException
     */
    public function testInvalidBooleanShouldRaiseException()
    {
        $validator = new BoolType();
        $this->assertFalse($validator->check('foo'));
    }

    public function testInvalidBooleanValuesShouldReturnFalse()
    {
        $validator = new BoolType();
        $this->assertFalse($validator->__invoke(''));
        $this->assertFalse($validator->__invoke('foo'));
        $this->assertFalse($validator->__invoke(123123));
        $this->assertFalse($validator->__invoke(new \stdClass()));
        $this->assertFalse($validator->__invoke([]));
        $this->assertFalse($validator->__invoke(1));
        $this->assertFalse($validator->__invoke(0));
        $this->assertFalse($validator->__invoke(null));
    }
}
