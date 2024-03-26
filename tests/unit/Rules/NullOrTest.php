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
#[CoversClass(NullOr::class)]
final class NullOrTest extends RuleTestCase
{
    #[Test]
    public function itShouldUseStandardTemplateWhenItHasNameWhenInputIsOptional(): void
    {
        $rule = new NullOr(Stub::pass(1));

        $result = $rule->evaluate(null);

        self::assertSame($rule, $result->rule);
        self::assertSame(NullOr::TEMPLATE_STANDARD, $result->template);
    }

    #[Test]
    public function itShouldUseNamedTemplateWhenItHasNameWhenInputIsNullable(): void
    {
        $rule = new NullOr(Stub::pass(1));
        $rule->setName('foo');

        $result = $rule->evaluate(null);

        self::assertSame($rule, $result->rule);
        self::assertSame(NullOr::TEMPLATE_NAMED, $result->template);
    }

    #[Test]
    public function itShouldUseWrappedRuleToEvaluateWhenNotNullable(): void
    {
        $input = new stdClass();

        $wrapped = Stub::pass(2);
        $rule = new NullOr($wrapped);

        self::assertEquals($wrapped->evaluate($input)->withPrefixedId('nullOr'), $rule->evaluate($input));
    }

    /** @return iterable<string, array{NullOr, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'null' => [new NullOr(Stub::daze()), null];
        yield 'not null with passing rule' => [new NullOr(Stub::pass(1)), 42];
    }

    /** @return iterable<array{NullOr, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield [new NullOr(Stub::fail(1)), ''];
        yield [new NullOr(Stub::fail(1)), 1];
        yield [new NullOr(Stub::fail(1)), []];
        yield [new NullOr(Stub::fail(1)), ' '];
        yield [new NullOr(Stub::fail(1)), 0];
        yield [new NullOr(Stub::fail(1)), '0'];
        yield [new NullOr(Stub::fail(1)), 0];
        yield [new NullOr(Stub::fail(1)), '0.0'];
        yield [new NullOr(Stub::fail(1)), false];
        yield [new NullOr(Stub::fail(1)), ['']];
        yield [new NullOr(Stub::fail(1)), [' ']];
        yield [new NullOr(Stub::fail(1)), [0]];
        yield [new NullOr(Stub::fail(1)), ['0']];
        yield [new NullOr(Stub::fail(1)), [false]];
        yield [new NullOr(Stub::fail(1)), [[''], [0]]];
        yield [new NullOr(Stub::fail(1)), new stdClass()];
    }
}
