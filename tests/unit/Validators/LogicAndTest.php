<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

#[Group('validator')]
#[CoversClass(LogicAnd::class)]
final class LogicAndTest extends RuleTestCase
{
    /** @return iterable<string, array{LogicAnd, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'pass, pass' => [new LogicAnd(Stub::pass(1), Stub::pass(1)), []];
        yield 'pass, pass, pass' => [new LogicAnd(Stub::pass(1), Stub::pass(1), Stub::pass(1)), []];
    }

    /** @return iterable<string, array{LogicAnd, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'pass, fail' => [new LogicAnd(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, pass' => [new LogicAnd(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, pass, fail' => [new LogicAnd(Stub::pass(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, pass' => [new LogicAnd(Stub::pass(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, pass' => [new LogicAnd(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []];
    }
}
