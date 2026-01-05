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

#[Group('validator')]
#[CoversClass(OneOf::class)]
final class OneOfTest extends RuleTestCase
{
    /** @return iterable<string, array{OneOf, mixed}> */
    public static function providerForValidInput(): iterable
    {
        yield 'fail, pass' => [new OneOf(Stub::fail(1), Stub::pass(1)), []];
        yield 'pass, fail' => [new OneOf(Stub::pass(1), Stub::fail(1)), []];
        yield 'pass, fail, fail' => [new OneOf(Stub::pass(1), Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, pass, fail' => [new OneOf(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []];
        yield 'fail, fail, pass' => [new OneOf(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []];
    }

    /** @return iterable<string, array{OneOf, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        yield 'fail, fail' => [new OneOf(Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, fail, fail' => [new OneOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []];
        yield 'fail, pass, pass' => [new OneOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []];
    }
}
