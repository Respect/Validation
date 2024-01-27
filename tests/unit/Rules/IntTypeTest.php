<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

use const PHP_INT_MAX;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\IntType
 */
final class IntTypeTest extends RuleTestCase
{
    /**
     * @return array<array{IntType, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new IntType();

        return [
            [$rule, 0],
            [$rule, 123456],
            [$rule, PHP_INT_MAX],
            [$rule, PHP_INT_MAX * -1],
        ];
    }

    /**
     * @return array<array{IntType, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new IntType();

        return [
            [$rule, '1'],
            [$rule, 1.0],
            [$rule, PHP_INT_MAX + 1],
            [$rule, true],
        ];
    }
}
