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

#[Group('rule')]
#[CoversClass(All::class)]
final class AllTest extends RuleTestCase
{
    /** @return iterable<string, array{All, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'all pass with array' => [new All(Stub::pass(3)), [1, 2, 3]];
        yield 'all pass with ArrayObject' => [new All(Stub::pass(3)), new ArrayObject([1, 2, 3])];
        yield 'single element that passes' => [new All(Stub::pass(1)), ['value']];
        yield 'all pass with array of strings' => [new All(Stub::pass(5)), ['a', 'b', 'c', 'd', 'e']];
    }

    /** @return iterable<string, array{All, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'some fail with array' => [new All(Stub::fail(3)), [1, 2, 3]];
        yield 'all fail with array' => [new All(Stub::fail(3)), [1, 2, 3]];
        yield 'mixed pass/fail with array' => [new All(Stub::any(3)), [1, 2, 3]];
        yield 'some fail with ArrayObject' => [new All(Stub::fail(3)), new ArrayObject([1, 2, 3])];
        yield 'non-array input' => [new All(Stub::daze()), 'not an array'];
        yield 'string input' => [new All(Stub::daze()), 'string'];
        yield 'integer input' => [new All(Stub::daze()), 123];
        yield 'null input' => [new All(Stub::daze()), null];
        yield 'boolean input' => [new All(Stub::daze()), true];
        yield 'object input' => [new All(Stub::daze()), (object) ['foo' => 'bar']];
        yield 'empty array' => [new All(Stub::daze()), []];
    }
}
