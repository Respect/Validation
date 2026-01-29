<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nawarian <nickolas@phpsp.org.br>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Pascal Borreli <pascal@borreli.com>
 * SPDX-FileContributor: William Espindola <oi@williamespindola.com.br>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

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
            [new Contains('foo'), ['bar', 'foo']],
            [new Contains('foo'), ['fool', 'foo']],
            [new Contains('foo'), 'foobazfoO'],
            [new Contains('foo'), 'barbazfoo'],
            [new Contains('foo'), 'foobazfoo'],
            [new Contains('1'), [2, 3, '1']],
            [new Contains('1'), [2, 3, (string) 1]],
            [new Contains('1'), [2, 3, '1']],
            [new Contains(1), [2, 3, 1]],
        ];
    }

    /** @return iterable<array{Contains, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Contains('foo'), 'barbazFOO'],
            [new Contains('1'), [2, 3, 1]],
            [new Contains(''), 'abc'],
            [new Contains(null), null],
            [new Contains(null), []],
            [new Contains(new stdClass()), new stdClass()],
            [new Contains('foo'), ''],
            [new Contains('bat'), ['bar', 'foo']],
            [new Contains('foo'), 'barfaabaz'],
            [new Contains('foo'), 'faabarbaz'],
            [new Contains('bat'), ['BAT', 'foo']],
            [new Contains('bat'), ['BaT', 'Batata']],
            [new Contains(1), ['1', 2, 3]],
        ];
    }
}
