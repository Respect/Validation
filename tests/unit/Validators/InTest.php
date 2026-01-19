<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Marcel Voigt <mv@noch.so>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(In::class)]
final class InTest extends RuleTestCase
{
    /** @return iterable<array{In, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new In(''), ''],
            [new In([null]), null],
            [new In(['0']), '0'],
            [new In([0]), 0],
            [new In(['foo', 'bar']), 'foo'],
            [new In('barfoobaz'), 'foo'],
            [new In('foobarbaz'), 'foo'],
            [new In('barbazfoo'), 'foo'],
            [new In([1, 2, 3]), '1'],
            [new In(['1', 2, 3], true), '1'],
        ];
    }

    /** @return iterable<array{In, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new In('0', true), 'abc'],
            [new In('0'), null],
            [new In(0, true), null],
            [new In('', true), null],
            [new In([], true), null],
            [new In('barfoobaz'), ''],
            [new In('barfoobaz'), null],
            [new In('barfoobaz'), 0],
            [new In('barfoobaz'), '0'],
            [new In(['foo', 'bar']), 'bat'],
            [new In('barfaabaz'), 'foo'],
            [new In('faabarbaz'), 'foo'],
            [new In('baabazfaa'), 'foo'],
            [new In([1, 2, 3], true), '1'],
        ];
    }
}
