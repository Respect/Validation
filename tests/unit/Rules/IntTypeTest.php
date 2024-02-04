<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(IntType::class)]
final class IntTypeTest extends RuleTestCase
{
    /** @return iterable<array{IntType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new IntType();

        return [
            [$rule, 0],
            [$rule, 123456],
            [$rule, PHP_INT_MAX],
            [$rule, PHP_INT_MAX * -1],
        ];
    }

    /** @return iterable<array{IntType, mixed}> */
    public static function providerForInvalidInput(): iterable
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
