<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Benevides <danilobenevides01@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Jean Pimentel <jeanfap@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('validator')]
#[CoversClass(Multiple::class)]
final class MultipleTest extends RuleTestCase
{
    /** @return iterable<array{Multiple, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Multiple(5), 20],
            [new Multiple(5), 5],
            [new Multiple(5), 0],
            [new Multiple(5), -500],
            [new Multiple(1), 0],
            [new Multiple(1), 1],
            [new Multiple(1), 2],
            [new Multiple(1), 3],
            [new Multiple(0), 0], // Only 0 is multiple of 0
        ];
    }

    /** @return iterable<array{Multiple, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Multiple(5), 11],
            [new Multiple(5), 3],
            [new Multiple(5), -1],
            [new Multiple(3), 4],
            [new Multiple(10), -8],
            [new Multiple(10), 57],
            [new Multiple(10), 21],
            [new Multiple(0), 1],
            [new Multiple(0), 2],
        ];
    }
}
