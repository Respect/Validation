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

use stdClass;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Equals
 * @covers Respect\Validation\Exceptions\EqualsException
 */
class EqualsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForEquals
     */
    public function testInputEqualsToExpectedValueShouldPass($compareTo, $input)
    {
        $rule = new Equals($compareTo);

        $this->assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotEquals
     */
    public function testInputNotEqualsToExpectedValueShouldPass($compareTo, $input)
    {
        $rule = new Equals($compareTo);

        $this->assertFalse($rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EqualsException
     * @expectedExceptionMessage "24" must be equals 42
     */
    public function testShouldThrowTheProperExceptionWhenFailure()
    {
        $rule = new Equals(42);
        $rule->check('24');
    }

    public function providerForEquals()
    {
        return [
            ['foo', 'foo'],
            [[], []],
            [new stdClass(), new stdClass()],
            [10, '10'],
        ];
    }

    public function providerForNotEquals()
    {
        return [
            ['foo', ''],
            ['foo', 'bar'],
        ];
    }
}
