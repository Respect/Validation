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
use stdClass;

use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(IntVal::class)]
final class IntValTest extends RuleTestCase
{
    /** @return iterable<array{IntVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new IntVal();

        return [
            [$rule, 16],
            [$rule, '165'],
            [$rule, 123456],
            [$rule, PHP_INT_MAX],
            [$rule, '06'],
            [$rule, '09'],
            [$rule, '0'],
            [$rule, '00'],
            [$rule, 0b101010],
            [$rule, 0x2a],
            [$rule, '089'],
            [$rule, -42],
            [$rule, '-42'],
            [$rule, '-042'],
        ];
    }

    /** @return iterable<array{IntVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new IntVal();

        return [
            [$rule, ''],
            [$rule, new stdClass()],
            [$rule, []],
            [$rule, null],
            [$rule, 'a'],
            [$rule, '1.0'],
            [$rule, 1.0],
            [$rule, ' '],
            [$rule, true],
            [$rule, false],
            [$rule, 'Foo'],
            [$rule, '1.44'],
            [$rule, 1e-5],
            [$rule, '089ab'],
        ];
    }
}
