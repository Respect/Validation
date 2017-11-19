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
 * @covers \Respect\Validation\Rules\Finite
 * @covers \Respect\Validation\Exceptions\FiniteException
 */
class FiniteTest extends TestCase
{
    protected $rule;

    protected function setUp(): void
    {
        $this->rule = new Finite();
    }

    /**
     * @dataProvider providerForFinite
     */
    public function testShouldValidateFiniteNumbers($input): void
    {
        self::assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonFinite
     */
    public function testShouldNotValidateNonFiniteNumbers($input): void
    {
        self::assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\FiniteException
     * @expectedExceptionMessage `INF` must be a finite number
     */
    public function testShouldThrowFiniteExceptionWhenChecking(): void
    {
        $this->rule->check(INF);
    }

    public function providerForFinite()
    {
        return [
            ['123456'],
            [-9],
            [0],
            [16],
            [2],
            [PHP_INT_MAX],
        ];
    }

    public function providerForNonFinite()
    {
        return [
            [' '],
            [INF],
            [[]],
            [new \stdClass()],
            [null],
        ];
    }
}
