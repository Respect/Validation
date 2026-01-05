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

#[Group('validator')]
#[CoversClass(IntVal::class)]
final class IntValTest extends RuleTestCase
{
    /** @return iterable<array{IntVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new IntVal();

        return [
            [$validator, 16],
            [$validator, '165'],
            [$validator, 123456],
            [$validator, PHP_INT_MAX],
            [$validator, '06'],
            [$validator, '09'],
            [$validator, '0'],
            [$validator, '00'],
            [$validator, 0b101010],
            [$validator, 0x2a],
            [$validator, '089'],
            [$validator, -42],
            [$validator, '-42'],
            [$validator, '-042'],
        ];
    }

    /** @return iterable<array{IntVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new IntVal();

        return [
            [$validator, ''],
            [$validator, new stdClass()],
            [$validator, []],
            [$validator, null],
            [$validator, 'a'],
            [$validator, '1.0'],
            [$validator, 1.0],
            [$validator, ' '],
            [$validator, true],
            [$validator, false],
            [$validator, 'Foo'],
            [$validator, '1.44'],
            [$validator, 1e-5],
            [$validator, '089ab'],
        ];
    }
}
