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
 * @covers \Respect\Validation\Exceptions\SortedException
 * @covers \Respect\Validation\Rules\Sorted
 */
class SortedTest extends TestCase
{
    /**
     * @test
     */
    public function passes(): void
    {
        $arr = [1, 2, 3];
        $rule = new Sorted();

        self::assertTrue($rule->validate($arr));
        $rule->assert($arr);
        $rule->check($arr);
    }

    /**
     * @test
     */
    public function passesWithEqualValues(): void
    {
        $arr = [1, 2, 2, 3];
        $rule = new Sorted();

        self::assertTrue($rule->validate($arr));
        $rule->assert($arr);
        $rule->check($arr);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SortedException
     *
     * @test
     */
    public function notPasses(): void
    {
        $arr = [1, 2, 4, 3];
        $rule = new Sorted();

        self::assertFalse($rule->validate($arr));
        $rule->check($arr);
    }

    /**
     * @test
     */
    public function passesDescending(): void
    {
        $arr = [10, 9, 8];
        $rule = new Sorted(null, false);

        self::assertTrue($rule->validate($arr));
        $rule->assert($arr);
        $rule->check($arr);
    }

    /**
     * @test
     */
    public function passesDescendingWithEqualValues(): void
    {
        $arr = [10, 9, 9, 8];
        $rule = new Sorted(null, false);

        self::assertTrue($rule->validate($arr));
        $rule->assert($arr);
        $rule->check($arr);
    }

    /**
     * @test
     */
    public function passesByFunction(): void
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
        $rule->assert($arr);
        $rule->check($arr);
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\SortedException
     *
     * @test
     */
    public function notPassesByFunction(): void
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
        $rule->check($arr);
    }
}
