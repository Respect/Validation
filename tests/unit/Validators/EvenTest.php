<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Paul Karikari <paulkarikari1@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

use const INF;

#[Group('validator')]
#[CoversClass(Even::class)]
final class EvenTest extends RuleTestCase
{
    /** @return iterable<array{Even, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Even(), 2],
            [new Even(), -2],
            [new Even(), 0],
            [new Even(), 32],
        ];
    }

    /** @return iterable<array{Even, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Even(), ''],
            [new Even(), INF],
            [new Even(), 2.2],
            [new Even(), -5],
            [new Even(), -1],
            [new Even(), 1],
            [new Even(), 13],
        ];
    }
}
