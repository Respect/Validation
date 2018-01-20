<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Between
 * @covers \Respect\Validation\Exceptions\BetweenException
 */
class BetweenTest extends TestCase
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
    public function testValuesBetweenBoundsShouldPass($min, $max, $inclusive, $input): void
    {
        $o = new Between($min, $max, $inclusive);
        self::assertTrue($o->__invoke($input));
        self::assertTrue($o->assert($input));
        self::assertTrue($o->check($input));
    }

    /**
     * @dataProvider providerInvalid
     * @expectedException \Respect\Validation\Exceptions\BetweenException
     */
    public function testValuesOutBoundsShouldRaiseException($min, $max, $inclusive, $input): void
    {
        $o = new Between($min, $max, $inclusive);
        self::assertFalse($o->__invoke($input));
        self::assertFalse($o->assert($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructionParamsShouldRaiseException(): void
    {
        $o = new Between(10, 5);
    }
}
