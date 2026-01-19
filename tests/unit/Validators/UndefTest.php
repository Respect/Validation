<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Undef::class)]
final class UndefTest extends RuleTestCase
{
    /** @return iterable<array{Undef, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Undef();

        return [
            [$validator, []],
            [$validator, ' '],
            [$validator, 0],
            [$validator, '0'],
            [$validator, 0],
            [$validator, '0.0'],
            [$validator, false],
            [$validator, ['']],
            [$validator, [' ']],
            [$validator, [0]],
            [$validator, ['0']],
            [$validator, [false]],
            [$validator, [[''], [0]]],
            [$validator, new stdClass()],
        ];
    }

    /** @return iterable<array{Undef, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Undef();

        return [
            [$validator, null],
            [$validator, ''],
        ];
    }
}
