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
#[CoversClass(LogicOr::class)]
final class LogicOrTest extends RuleTestCase
{
    /** @return iterable<string, array{LogicOr, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, pass' => [new LogicOr(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, fail' => [new LogicOr(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, fail, pass' => [new LogicOr(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, fail' => [new LogicOr(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, fail' => [new LogicOr(Stub::pass(1), Stub::fail(1), Stub::fail(1)), []];
    }

    /** @return iterable<string, array{LogicOr, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'fail, fail' => [new LogicOr(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new LogicOr(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
    }
}
