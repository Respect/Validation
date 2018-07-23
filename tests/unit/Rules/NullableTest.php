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
use Respect\Validation\Validatable;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Nullable
 *
 * @author Jens Segers <segers.jens@gmail.com>
 */
final class NullableTest extends TestCase
{
    /**
     * Data provider for not nullable values.
     *
     * @return array
     */
    public function providerForNotNullable(): array
    {
        return [
            [''],
            [1],
            [[]],
            [' '],
            [0],
            ['0'],
            [0],
            ['0.0'],
            [false],
            [['']],
            [[' ']],
            [[0]],
            [['0']],
            [[false]],
            [[[''], [0]]],
            [new stdClass()],
        ];
    }

    /**
     * @test
     */
    public function shouldNotValidateRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('validate');

        $rule = new Nullable($validatable);

        self::assertTrue($rule->validate(null));
    }

    /**
     * @dataProvider providerForNotNullable
     *
     * @param mixed $input
     *
     * @test
     */
    public function shouldValidateRuleWhenInputIsNotNullable($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Nullable($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function shouldNotAssertRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('assert');

        $rule = new Nullable($validatable);
        $rule->assert(null);
    }

    /**
     * @test
     *
     * @dataProvider providerForNotNullable
     *
     * @param mixed $input
     */
    public function shouldAssertRuleWhenInputIsNotNullable($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Nullable($validatable);
        $rule->assert($input);
    }

    /**
     * @test
     */
    public function shouldNotCheckRuleWhenInputIsNull(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('check');

        $rule = new Nullable($validatable);
        $rule->check(null);
    }

    /**
     * @test
     *
     * @dataProvider providerForNotNullable
     *
     * @param mixed $input
     */
    public function shouldCheckRuleWhenInputIsNotNullable($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Nullable($validatable);
        $rule->check($input);
    }
}
