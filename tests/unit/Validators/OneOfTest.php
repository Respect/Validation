<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Bradyn Poulsen <bradyn@bradynpoulsen.com>
 * SPDX-FileContributor: Gabriel Caruso <carusogabriel34@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Validators\Stub;

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
