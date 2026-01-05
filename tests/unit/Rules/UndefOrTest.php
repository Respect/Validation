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
use stdClass;

#[Group('validator')]
#[CoversClass(UndefOr::class)]
final class UndefOrTest extends RuleTestCase
{
    /** @return iterable<string, array{UndefOr, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'null' => [new UndefOr(Stub::pass(1)), null];
        yield 'empty string' => [new UndefOr(Stub::pass(1)), ''];
        yield 'null with failing rule' => [new UndefOr(Stub::fail(1)), null];
        yield 'empty string with failing rule' => [new UndefOr(Stub::fail(1)), ''];
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
