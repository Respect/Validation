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
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Each::class)]
final class EachTest extends RuleTestCase
{
    /** @return iterable<array{Each, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Each(Stub::pass(5)), [1, 2, 3, 4, 5]],
            [new Each(Stub::pass(5)), new ArrayObject([1, 2, 3, 4, 5])],
        ];
    }

    /** @return iterable<array{Each, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Each(Stub::daze()), []],
            [new Each(Stub::daze()), new stdClass()],
            [new Each(Stub::daze()), 123],
            [new Each(Stub::daze()), ''],
            [new Each(Stub::daze()), null],
            [new Each(Stub::daze()), false],
            [new Each(Stub::fail(5)), ['', 2, 3, 4, 5]],
            [new Each(Stub::fail(5)), ['a', 2, 3, 4, 5]],
            [new Each(Stub::fail(5)), new ArrayObject([1, 2, 3, 4, 5])],
            [new Each(Stub::fail(5)), (object) ['foo' => true]],
        ];
    }
}
