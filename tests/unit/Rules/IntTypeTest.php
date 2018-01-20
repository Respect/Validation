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
 * @covers \Respect\Validation\Rules\IntType
 */
class IntTypeTest extends TestCase
{
    public function providerForValidIntType()
    {
        return [
            [0],
            [123456],
            [PHP_INT_MAX],
            [PHP_INT_MAX * -1],
        ];
    }

    /**
     * @dataProvider providerForValidIntType
     */
    public function testShouldValidateInputWhenItIsAValidIntType($input): void
    {
        $rule = new IntType();

        self::assertTrue($rule->validate($input));
    }

    public function providerForInvalidIntType()
    {
        return [
            ['1'],
            [1.0],
            [PHP_INT_MAX + 1],
            [true],
        ];
    }

    /**
     * @dataProvider providerForInvalidIntType
     */
    public function testShouldInvalidateInputWhenItIsNotAValidIntType($input): void
    {
        $rule = new IntType();

        self::assertFalse($rule->validate($input));
    }
}
