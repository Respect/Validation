<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(NullType::class)]
final class NullTypeTest extends RuleTestCase
{
    /** @return iterable<array{NullType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new NullType();

        return [
            [$validator, null],
        ];
    }

    /** @return iterable<array{NullType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new NullType();

        return [
            [$validator, ''],
            [$validator, false],
            [$validator, []],
            [$validator, 0],
            [$validator, 'w poiur'],
        ];
    }
}
