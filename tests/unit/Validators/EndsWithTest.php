<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(EndsWith::class)]
final class EndsWithTest extends RuleTestCase
{
    /** @return iterable<array{EndsWith, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new EndsWith('foo'), ['bar', 'foo']],
            [new EndsWith('foo'), 'barbazfoo'],
            [new EndsWith('foo'), 'foobazfoo'],
            [new EndsWith('foo', 'bar'), 'bazbar'],
            [new EndsWith('foo', 'bar'), ['baz', 'bar']],
            [new EndsWith(1), [2, 3, 1]],
            [new EndsWith('1'), [2, 3, '1']],
        ];
    }

    /** @return iterable<array{EndsWith, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new EndsWith('foo'), ''],
            [new EndsWith('bat'), ['bar', 'foo']],
            [new EndsWith('foo'), 'barfaabaz'],
            [new EndsWith('foo'), 'barbazFOO'],
            [new EndsWith('foo'), 'faabarbaz'],
            [new EndsWith('foo'), 'baabazfaa'],
            [new EndsWith('foo'), 'baafoofaa'],
            [new EndsWith('foo', 'bar'), 'foobaz'],
            [new EndsWith('foo', 'bar'), ['foo', 'baz']],
            [new EndsWith('1'), [1, '1', 3]],
            [new EndsWith('1'), [2, 3, 1]],
            // non-string inputs/values should not trigger warnings
            [new EndsWith('foo'), 123],
            [new EndsWith(123), 'foo'],
        ];
    }
}
