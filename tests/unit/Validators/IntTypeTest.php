<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(IntType::class)]
final class IntTypeTest extends RuleTestCase
{
    /** @return iterable<array{IntType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new IntType();

        return [
            [$validator, 0],
            [$validator, 123456],
            [$validator, PHP_INT_MAX],
            [$validator, PHP_INT_MAX * -1],
        ];
    }

    /** @return iterable<array{IntType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new IntType();

        return [
            [$validator, '1'],
            [$validator, 1.0],
            [$validator, PHP_INT_MAX + 1],
            [$validator, true],
        ];
    }
}
