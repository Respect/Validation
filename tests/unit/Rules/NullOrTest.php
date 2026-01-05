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
#[CoversClass(NullOr::class)]
final class NullOrTest extends RuleTestCase
{
    /** @return iterable<string, array{NullOr, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'null with passing rule' => [new NullOr(Stub::pass(1)), null];
        yield 'null with failing rule' => [new NullOr(Stub::fail(1)), null];
        yield 'not null with passing rule' => [new NullOr(Stub::pass(1)), 42];
    }

    /** @return iterable<array{NullOr, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield [new NullOr(Stub::fail(1)), ''];
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
