<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(KeySet::class)]
final class KeySetTest extends RuleTestCase
{
    #[Test]
    public function nonKeyRelatedRuleShouldNotBeAllowed(): void
    {
        $this->expectException(InvalidRuleConstructorException::class);
        $this->expectExceptionMessage('You must provide only key-related rules');

        new KeySet(new Equals('foo'));
    }

    /** @return iterable<string, array{KeySet, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'correct keys, with passing rule' => [new KeySet(new Key('foo', Stub::pass(1))), ['foo' => 'bar']];
    }

    /** @return iterable<string, array{KeySet, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'not an array' => [new KeySet(new KeyExists('foo')), null];
        yield 'missing keys' => [new KeySet(new KeyExists('foo')), []];
        yield 'extra keys, missing keys' => [
            new KeySet(new KeyExists('foo')),
            ['baz' => 'qux'],
        ];
        yield 'extra keys, failed rule' => [
            new KeySet(new Key('foo', Stub::pass(1))),
            ['foo' => 'bar', 'baz' => 'qux'],
        ];
        yield 'missing key, failed rule' => [
            new KeySet(new Key('foo', Stub::fail(1)), new KeyExists('bar')),
            ['foo' => 'bar', 'baz' => 'qux'],
        ];
        yield 'extra keys, with failing rule' => [
            new KeySet(new Key('foo', Stub::fail(1))),
            ['foo' => 'bar', 'baz' => 'qux'],
        ];
        yield 'correct keys, with failing rule' => [new KeySet(new Key('foo', Stub::fail(1))), ['foo' => 'bar']];
    }
}
