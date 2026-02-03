<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ismael Elias <ismael.esq@hotmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Positive::class)]
final class PositiveTest extends RuleTestCase
{
    /** @return iterable<array{Positive, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Positive();

        return [
            [$validator, 16],
            [$validator, '165'],
            [$validator, 123456],
            [$validator, 1e10],
        ];
    }

    /** @return iterable<array{Positive, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Positive();

        return [
            [$validator, ''],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, null],
            [$validator, 'a'],
            [$validator, ' '],
            [$validator, 'Foo'],
            [$validator, '-1.44'],
            [$validator, -1e-5],
            [$validator, 0],
            [$validator, -0],
            [$validator, -10],
        ];
    }
}
