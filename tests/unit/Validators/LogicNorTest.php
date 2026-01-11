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
#[CoversClass(LogicNor::class)]
final class LogicNorTest extends RuleTestCase
{
    /** @return iterable<string, array{LogicNor, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, fail' => [new LogicNor(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new LogicNor(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
    }

    /** @return iterable<string, array{LogicNor, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'pass, fail' => [new LogicNor(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, pass' => [new LogicNor(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, pass, fail' => [new LogicNor(Stub::pass(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, pass' => [new LogicNor(Stub::pass(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, pass' => [new LogicNor(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []];
    }
}
