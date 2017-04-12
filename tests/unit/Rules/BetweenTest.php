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

use DateTime;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Between
 * @covers \Respect\Validation\Exceptions\BetweenException
 */
class BetweenTest extends \PHPUnit_Framework_TestCase
{
    public function providerValid()
    {
        return [
            [0, 1, true, 0],
            [0, 1, true, 1],
            [10, 20, false, 15],
            [10, 20, true, 20],
            [-10, 20, false, -5],
            [-10, 20, false, 0],
            ['a', 'z', false, 'j'],
            [
                new DateTime('yesterday'),
                new DateTime('tomorrow'),
                false,
                new DateTime('now'),
            ],
        ];
    }

    public function providerInvalid()
    {
        return [
            [10, 20, false, ''],
            [10, 20, true, ''],
            [0, 1, false, 0],
            [0, 1, false, 1],
            [0, 1, false, 2],
            [0, 1, false, -1],
            [10, 20, false, 999],
            [10, 20, false, 20],
            [-10, 20, false, -11],
            ['a', 'j', false, 'z'],
            [
                new DateTime('yesterday'),
                new DateTime('now'),
                false,
                new DateTime('tomorrow'),
            ],
        ];
    }

    /**
     * @dataProvider providerValid
     */
    public function testValuesBetweenBoundsShouldPass($min, $max, $inclusive, $input)
    {
        $o = new Between($min, $max, $inclusive);
        $this->assertTrue($o->__invoke($input));
        $this->assertTrue($o->assert($input));
        $this->assertTrue($o->check($input));
    }

    /**
     * @dataProvider providerInvalid
     * @expectedException \Respect\Validation\Exceptions\BetweenException
     */
    public function testValuesOutBoundsShouldRaiseException($min, $max, $inclusive, $input)
    {
        $o = new Between($min, $max, $inclusive);
        $this->assertFalse($o->__invoke($input));
        $this->assertFalse($o->assert($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructionParamsShouldRaiseException()
    {
        $o = new Between(10, 5);
    }
}
