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
#[CoversClass(AnyOf::class)]
final class AnyOfTest extends RuleTestCase
{
    /** @return iterable<string, array{AnyOf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, pass' => [new AnyOf(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, fail' => [new AnyOf(Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, fail, pass' => [new AnyOf(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []];
        yield 'fail, pass, fail' => [new AnyOf(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, fail' => [new AnyOf(Stub::pass(1), Stub::fail(1), Stub::fail(1)), []];
    }

    /** @return iterable<string, array{AnyOf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'fail, fail' => [new AnyOf(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new AnyOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
    }
}
