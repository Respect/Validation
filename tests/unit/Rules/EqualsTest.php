<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

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
