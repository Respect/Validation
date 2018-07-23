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
 * @group  rule
 * @covers \Respect\Validation\Rules\Optional
 */
class OptionalTest extends TestCase
{
    public function providerForOptional()
    {
        return [
            [null],
            [''],
        ];
    }

    public function providerForNotOptional()
    {
        return [
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
     * @dataProvider providerForOptional
     *
     * @test
     */
    public function shouldNotValidateRuleWhenInputIsOptional($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('validate');

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForNotOptional
     *
     * @test
     */
    public function shouldValidateRuleWhenInputIsNotOptional($input): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('validate')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Optional($validatable);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function shouldNotAssertRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('assert');

        $rule = new Optional($validatable);

        $rule->assert('');
    }

    /**
     * @test
     */
    public function shouldAssertRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('assert')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Optional($validatable);

        $rule->assert($input);
    }

    /**
     * @test
     */
    public function shouldNotCheckRuleWhenInputIsOptional(): void
    {
        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::never())
            ->method('check');

        $rule = new Optional($validatable);

        $rule->check('');
    }

    /**
     * @test
     */
    public function shouldCheckRuleWhenInputIsNotOptional(): void
    {
        $input = 'foo';

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($input)
            ->will(self::returnValue(true));

        $rule = new Optional($validatable);

        $rule->check($input);
    }
}
