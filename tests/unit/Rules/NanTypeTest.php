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
 * @covers Respect\Validation\Rules\NanType
 * @covers Respect\Validation\Exceptions\NanTypeException
 */
class NanTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NanType();
    }

    /**
     * @dataProvider providerForNanValue
     */
    public function testNanValue($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotNan
     * @expectedException Respect\Validation\Exceptions\NanTypeException
     */
    public function testNotNan($input)
    {
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNanValue()
    {
        return [
            [acos(1.01)],
            [sqrt(-1)],
        ];
    }

    public function providerForNotNan()
    {
        return [
            [123456],
            [PHP_INT_MAX],
        ];
    }
}
