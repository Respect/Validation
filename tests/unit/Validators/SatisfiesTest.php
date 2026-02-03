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
use Respect\Validation\Test\Validators\Stub;
use stdClass;

#[Group('validator')]
#[CoversClass(Satisfies::class)]
final class SatisfiesTest extends RuleTestCase
{
    /** @return iterable<array{Satisfies, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Satisfies('is_a', 'stdClass'), new stdClass()],
            [new Satisfies([Stub::pass(1), 'isValid']), 'test'],
            [new Satisfies('is_string'), 'test'],
            [
                new Satisfies(static function () {
                    return true;
                }),
                'wpoiur',
            ],
        ];
    }

    /** @return iterable<array{Satisfies, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [
                new Satisfies(static function () {
                    return false;
                }),
                'w poiur',
            ],
            [
                new Satisfies(static function () {
                    return false;
                }),
                '',
            ],
        ];
    }
}
