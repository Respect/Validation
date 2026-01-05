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

use function acos;
use function sqrt;

use const INF;
use const NAN;
use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(Number::class)]
final class NumberTest extends RuleTestCase
{
    /** @return iterable<array{Number, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Number();

        return [
            [$validator, '42'],
            [$validator, 123456],
            [$validator, 0.00000000001],
            [$validator, '0.5'],
            [$validator, PHP_INT_MAX],
            [$validator, -PHP_INT_MAX],
            [$validator, INF],
            [$validator, -INF],
        ];
    }

    /** @return iterable<array{Number, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Number();

        return [
            [$validator, acos(1.01)],
            [$validator, sqrt(-1)],
            [$validator, NAN],
            [$validator, -NAN],
            [$validator, false],
            [$validator, true],
            [$validator, []],
            [$validator, new stdClass()],
        ];
    }
}
