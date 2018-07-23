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
 * @covers \Respect\Validation\Exceptions\FiniteException
 * @covers \Respect\Validation\Rules\Finite
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
     *
     * @test
     */
    public function shouldValidateFiniteNumbers($input): void
    {
        self::assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonFinite
     *
     * @test
     */
    public function shouldNotValidateNonFiniteNumbers($input): void
    {
        self::assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\FiniteException
     * @expectedExceptionMessage `INF` must be a finite number
     *
     * @test
     */
    public function shouldThrowFiniteExceptionWhenChecking(): void
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
