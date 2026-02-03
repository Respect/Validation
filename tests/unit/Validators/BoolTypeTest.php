<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Devin Torres <devin@devintorres.com>
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
#[CoversClass(BoolType::class)]
final class BoolTypeTest extends RuleTestCase
{
    /** @return iterable<array{BoolType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new BoolType();

        return [
            [$validator, true],
            [$validator, false],
        ];
    }

    /** @return iterable<array{BoolType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new BoolType();

        return [
            [$validator, ''],
            [$validator, 'foo'],
            [$validator, 123123],
            [$validator, new stdClass()],
            [$validator, []],
            [$validator, 1],
            [$validator, 0],
            [$validator, null],
        ];
    }
}
