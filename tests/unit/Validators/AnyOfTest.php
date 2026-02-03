<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
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
