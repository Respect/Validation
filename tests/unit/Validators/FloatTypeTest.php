<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: João Torquato <joao.otl@gmail.com>
 * SPDX-FileContributor: Reginaldo Junior <76regi@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(FloatType::class)]
final class FloatTypeTest extends RuleTestCase
{
    /** @return iterable<array{FloatType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new FloatType();

        return [
            [$validator, 165.23],
            [$validator, 1.3e3],
            [$validator, 7E-10],
            [$validator, 0.0],
            [$validator, -2.44],
            [$validator, 10 / 33.33],
            [$validator, PHP_INT_MAX + 1],
        ];
    }

    /** @return iterable<array{FloatType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new FloatType();

        return [
            [$validator, '1'],
            [$validator, '1.0'],
            [$validator, '7E-10'],
            [$validator, 111111],
            [$validator, PHP_INT_MAX * -1],
        ];
    }
}
