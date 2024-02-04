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

use const INF;
use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(Infinite::class)]
final class InfiniteTest extends RuleTestCase
{
    /** @return iterable<array{Infinite, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Infinite();

        return [
            [$rule, INF],
            [$rule, INF * -1],
        ];
    }

    /** @return iterable<array{Infinite, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Infinite();

        return [
            [$rule, ' '],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, '123456'],
            [$rule, -9],
            [$rule, 0],
            [$rule, 16],
            [$rule, 2],
            [$rule, PHP_INT_MAX],
        ];
    }
}
