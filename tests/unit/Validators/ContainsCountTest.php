<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(ContainsCount::class)]
final class ContainsCountTest extends RuleTestCase
{
    /** @return iterable<array{ContainsCount, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new ContainsCount('foo', 2), ['foo', 'bar', 'foo']],
            [new ContainsCount('foo', 1), 'foo bar'],
            [new ContainsCount('foo', 2), 'foo bar foo'],
            [new ContainsCount('a', 3), 'banana'],

            [new ContainsCount('1', 1, true), ['1', 2, 3]],
            [new ContainsCount(1, 1, true), [1, 2, 3]],

            [new ContainsCount('A', 3), 'banana'],
            [new ContainsCount('foo', 2), 'FOO bar foo'],

            [new ContainsCount('A', 0, true), 'banana'],
            [new ContainsCount('a', 3, true), 'banana'],

            [new ContainsCount('foo', 0), 'bar'],
        ];
    }

    /** @return iterable<array{ContainsCount, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new ContainsCount('foo', 2), ['foo', 'bar']],
            [new ContainsCount('foo', 2), 'foo bar'],
            [new ContainsCount('a', 2), 'banana'],

            [new ContainsCount('1', 1, true), [1, 2, 3]],

            [new ContainsCount('A', 2), 'banana'],

            [new ContainsCount('A', 3, true), 'banana'],

            [new ContainsCount('foo', 1), null],
            [new ContainsCount('foo', 1), new stdClass()],

            [new ContainsCount('', 1), ''],
        ];
    }
}
