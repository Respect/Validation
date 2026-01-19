<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Ian <ian@glutenite.co.uk>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 * SPDX-FileContributor: Pascal Borreli <pascal@borreli.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Equals::class)]
final class EqualsTest extends RuleTestCase
{
    /** @return iterable<array{Equals, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Equals('foo'), 'foo'],
            [new Equals([]), []],
            [new Equals(new stdClass()), new stdClass()],
            [new Equals(10), '10'],
            [new Equals(10), 10.0],
        ];
    }

    /** @return iterable<array{Equals, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Equals(2), new ArrayObject([1, 2])],
            [new Equals('foo'), ''],
            [new Equals('foo'), 'bar'],
        ];
    }
}
