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

use Respect\Validation\TestCase;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Infinite
 * @covers Respect\Validation\Exceptions\InfiniteException
 */
class InfiniteTest extends TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new Infinite();
    }

    /**
     * @dataProvider providerForInfinite
     */
    public function testShouldValidateInfiniteNumbers($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonInfinite
     */
    public function testShouldNotValidateNonInfiniteNumbers($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InfiniteException
     * @expectedExceptionMessage 123456 must be an infinite number
     */
    public function testShouldThrowInfiniteExceptionWhenChecking()
    {
        $this->rule->check(123456);
    }

    public function providerForInfinite()
    {
        return [
            [INF],
            [INF * -1],
        ];
    }

    public function providerForNonInfinite()
    {
        return [
            [' '],
            [[]],
            [new \stdClass()],
            [null],
            ['123456'],
            [-9],
            [0],
            [16],
            [2],
            [PHP_INT_MAX],
        ];
    }
}
