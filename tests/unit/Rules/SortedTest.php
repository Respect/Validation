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

use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Sorted
 * @covers \Respect\Validation\Exceptions\SortedException
 */
class SortedTest extends TestCase
{
    public function testPasses(): void
    {
        $arr = [1, 2, 3];
        $rule = new Sorted();

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    public function testPassesWithEqualValues(): void
    {
        $arr = [1, 2, 2, 3];
        $rule = new Sorted();

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SortedException
     */
    public function testNotPasses(): void
    {
        $arr = [1, 2, 4, 3];
        $rule = new Sorted();

        self::assertFalse($rule->validate($arr));
        self::assertFalse($rule->check($arr));
    }

    public function testPassesDescending(): void
    {
        $arr = [10, 9, 8];
        $rule = new Sorted(null, false);

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    public function testPassesDescendingWithEqualValues(): void
    {
        $arr = [10, 9, 9, 8];
        $rule = new Sorted(null, false);

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    public function testPassesByFunction(): void
    {
        $arr = [
            [
                'key' => 1,
            ],
            [
                'key' => 2,
            ],
            [
                'key' => 5,
            ],
        ];
        $rule = new Sorted(function ($x) {
            return $x['key'];
        });

        self::assertTrue($rule->validate($arr));
        self::assertTrue($rule->assert($arr));
        self::assertTrue($rule->check($arr));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SortedException
     */
    public function testNotPassesByFunction(): void
    {
        $arr = [
            [
                'key' => 1,
            ],
            [
                'key' => 8,
            ],
            [
                'key' => 5,
            ],
        ];
        $rule = new Sorted(function ($x) {
            return $x['key'];
        });

        self::assertFalse($rule->validate($arr));
        self::assertFalse($rule->check($arr));
    }
}
