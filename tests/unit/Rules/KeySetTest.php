<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(KeySet::class)]
final class KeySetTest extends RuleTestCase
{
    /** @return iterable<string, array{KeySet, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'correct keys, with passing rule' => [new KeySet(new Key('foo', Stub::pass(1))), ['foo' => 'bar']];
    }

    /** @return iterable<string, array{KeySet, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'not array' => [new KeySet(new Key('foo', Stub::daze())), null];
        yield 'missing keys' => [new KeySet(new Key('foo', Stub::daze())), []];
        yield 'extra keys' => [new KeySet(new Key('foo', Stub::daze())), ['foo' => 'bar', 'baz' => 'qux']];
        yield 'correct keys, with failing rule' => [new KeySet(new Key('foo', Stub::fail(1))), ['foo' => 'bar']];
    }
}
