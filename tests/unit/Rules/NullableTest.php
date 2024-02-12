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
use Respect\Validation\Test\Rules\Stub;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(Nullable::class)]
final class NullableTest extends RuleTestCase
{
    #[Test]
    public function itShouldUseStandardTemplateWhenItHasNameWhenInputIsOptional(): void
    {
        $rule = new Nullable(Stub::pass(1));

        $result = $rule->evaluate(null);

        self::assertSame($rule, $result->rule);
        self::assertSame(Nullable::TEMPLATE_STANDARD, $result->template);
    }

    #[Test]
    public function itShouldUseNamedTemplateWhenItHasNameWhenInputIsNullable(): void
    {
        $rule = new Nullable(Stub::pass(1));
        $rule->setName('foo');

        $result = $rule->evaluate(null);

        self::assertSame($rule, $result->rule);
        self::assertSame(Nullable::TEMPLATE_NAMED, $result->template);
    }

    #[Test]
    public function itShouldUseWrappedRuleToEvaluateWhenNotNullable(): void
    {
        $input = new stdClass();

        $wrapped = Stub::pass(2);
        $rule = new Nullable($wrapped);

        self::assertEquals($wrapped->evaluate($input), $rule->evaluate($input));
    }

    /** @return iterable<string, array{Nullable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'null' => [new Nullable(Stub::daze()), null];
        yield 'not null with passing rule' => [new Nullable(Stub::pass(1)), 42];
    }

    /** @return iterable<array{Nullable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield [new Nullable(Stub::fail(1)), ''];
        yield [new Nullable(Stub::fail(1)), 1];
        yield [new Nullable(Stub::fail(1)), []];
        yield [new Nullable(Stub::fail(1)), ' '];
        yield [new Nullable(Stub::fail(1)), 0];
        yield [new Nullable(Stub::fail(1)), '0'];
        yield [new Nullable(Stub::fail(1)), 0];
        yield [new Nullable(Stub::fail(1)), '0.0'];
        yield [new Nullable(Stub::fail(1)), false];
        yield [new Nullable(Stub::fail(1)), ['']];
        yield [new Nullable(Stub::fail(1)), [' ']];
        yield [new Nullable(Stub::fail(1)), [0]];
        yield [new Nullable(Stub::fail(1)), ['0']];
        yield [new Nullable(Stub::fail(1)), [false]];
        yield [new Nullable(Stub::fail(1)), [[''], [0]]];
        yield [new Nullable(Stub::fail(1)), new stdClass()];
    }
}
