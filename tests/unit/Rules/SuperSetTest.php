<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Singwai Chan <c.singwai@gmail.com>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\SuperSet
 * @covers \Respect\Validation\Exceptions\SuperSetException
 */
class SuperSetTest extends TestCase
{
    /**
     * @dataProvider providerForSuperSet
     */
    public function testInputEqualsToExpectedValueShouldPass($compareTo, $input)
    {
        $rule = new SuperSet($compareTo);
        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotSuperSet
     */
    public function testInputNotEqualsToExpectedValueShouldPass($compareTo, $input)
    {
        $rule = new SuperSet($compareTo);
        self::assertFalse($rule->validate($input));
    }

    public function providerForSuperSet()
    {
        return [
            [[], []],
            [[1], [1]],
            [[1, 1], [1]],
            [[1], [1, 1]],
            [[2, 1, 3], [1, 2]],
            [['a', 1, 2], [1]],
        ];
    }

    public function providerForNotSuperSet()
    {
        return [
            [[], [1]],
            [[1], [2]],
            [['a', 'b'], ['c']],
        ];
    }
}
