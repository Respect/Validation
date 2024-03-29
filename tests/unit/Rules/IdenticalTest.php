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

#[Group('rule')]
#[CoversClass(Identical::class)]
final class IdenticalTest extends RuleTestCase
{
    /** @return iterable<array{Identical, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $object = new stdClass();

        return [
            [new Identical('foo'), 'foo'],
            [new Identical([]), []],
            [new Identical($object), $object],
            [new Identical(10), 10],
            [new Identical(10.0), 10.0],
        ];
    }

    /** @return iterable<array{Identical, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Identical(2), new ArrayObject([1, 2])],
            [new Identical(42), '42'],
            [new Identical('foo'), 'bar'],
            [new Identical([1]), []],
            [new Identical(new stdClass()), new stdClass()],
            [new Identical(10), 10.0],
        ];
    }
}
