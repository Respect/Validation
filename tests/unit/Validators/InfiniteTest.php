<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use const INF;
use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(Infinite::class)]
final class InfiniteTest extends RuleTestCase
{
    /** @return iterable<array{Infinite, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Infinite();

        return [
            [$validator, INF],
            [$validator, INF * -1],
        ];
    }

    /** @return iterable<array{Infinite, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Infinite();

        return [
            [$validator, ' '],
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, null],
            [$validator, '123456'],
            [$validator, -9],
            [$validator, 0],
            [$validator, 16],
            [$validator, 2],
            [$validator, PHP_INT_MAX],
        ];
    }
}
