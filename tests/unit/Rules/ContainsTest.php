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

#[Group('validator')]
#[CoversClass(Contains::class)]
final class ContainsTest extends RuleTestCase
{
    /** @return iterable<array{Contains, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Contains('foo', false), ['bar', 'foo']],
            [new Contains('foo', false), 'barbazFOO'],
            [new Contains('foo', false), 'barbazfoo'],
            [new Contains('foo', false), 'foobazfoO'],
            [new Contains('1', false), [2, 3, 1]],
            [new Contains('1', false), [2, 3, '1']],
            [new Contains('foo'), ['fool', 'foo']],
            [new Contains('foo'), 'barbazfoo'],
            [new Contains('foo'), 'foobazfoo'],
            [new Contains('1'), [2, 3, (string) 1]],
            [new Contains('1'), [2, 3, '1']],
            [new Contains(1), [2, 3, 1]],
        ];
    }

    /** @return iterable<array{Contains, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Contains('', false), 'abc'],
            [new Contains(null, false), null],
            [new Contains(null, false), []],
            [new Contains(new stdClass(), false), new stdClass()],
            [new Contains('foo', false), ''],
            [new Contains('bat', false), ['bar', 'foo']],
            [new Contains('foo', false), 'barfaabaz'],
            [new Contains('foo', false), 'faabarbaz'],
            [new Contains(null, true), null],
            [new Contains(null, true), []],
            [new Contains(new stdClass(), true), new stdClass()],
            [new Contains('foo', true), ''],
            [new Contains('bat', true), ['BAT', 'foo']],
            [new Contains('bat', true), ['BaT', 'Batata']],
            [new Contains('foo', true), 'barfaabaz'],
            [new Contains('foo', true), 'barbazFOO'],
            [new Contains('foo', true), 'faabarbaz'],
            [new Contains(1, true), ['1', 2, 3]],
        ];
    }
}
