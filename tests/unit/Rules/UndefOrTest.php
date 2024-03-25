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
#[CoversClass(UndefOr::class)]
final class UndefOrTest extends RuleTestCase
{
    #[Test]
    public function itShouldUseStandardTemplateWhenItHasNameWhenInputIsOptional(): void
    {
        $rule = new UndefOr(Stub::pass(1));

        $result = $rule->evaluate('');

        self::assertSame($rule, $result->rule);
        self::assertSame(UndefOr::TEMPLATE_STANDARD, $result->template);
    }

    #[Test]
    public function itShouldUseNamedTemplateWhenItHasNameWhenInputIsOptional(): void
    {
        $rule = new UndefOr(Stub::pass(1));
        $rule->setName('foo');

        $result = $rule->evaluate('');

        self::assertSame($rule, $result->rule);
        self::assertSame(UndefOr::TEMPLATE_NAMED, $result->template);
    }

    #[Test]
    public function itShouldUseWrappedRuleToEvaluateWhenNotOptional(): void
    {
        $input = new stdClass();

        $wrapped = Stub::pass(2);
        $rule = new UndefOr($wrapped);

        self::assertEquals($wrapped->evaluate($input)->withPrefixedId('undefOr'), $rule->evaluate($input));
    }

    /** @return iterable<string, array{UndefOr, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'null' => [new UndefOr(Stub::daze()), null];
        yield 'empty string' => [new UndefOr(Stub::daze()), ''];
        yield 'not optional' => [new UndefOr(Stub::pass(1)), 42];
    }

    /** @return iterable<array{UndefOr, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield [new UndefOr(Stub::fail(1)), 1];
        yield [new UndefOr(Stub::fail(1)), []];
        yield [new UndefOr(Stub::fail(1)), ' '];
        yield [new UndefOr(Stub::fail(1)), 0];
        yield [new UndefOr(Stub::fail(1)), '0'];
        yield [new UndefOr(Stub::fail(1)), 0];
        yield [new UndefOr(Stub::fail(1)), '0.0'];
        yield [new UndefOr(Stub::fail(1)), false];
        yield [new UndefOr(Stub::fail(1)), ['']];
        yield [new UndefOr(Stub::fail(1)), [' ']];
        yield [new UndefOr(Stub::fail(1)), [0]];
        yield [new UndefOr(Stub::fail(1)), ['0']];
        yield [new UndefOr(Stub::fail(1)), [false]];
        yield [new UndefOr(Stub::fail(1)), [[''], [0]]];
        yield [new UndefOr(Stub::fail(1)), new stdClass()];
    }
}
