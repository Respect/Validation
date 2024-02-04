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
#[CoversClass(NoneOf::class)]
final class NoneOfTest extends RuleTestCase
{
    /** @return array<array{NoneOf, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'fail' => [new NoneOf(Stub::fail(1)), []],
            'fail, fail' => [new NoneOf(Stub::fail(1), Stub::fail(1)), []],
            'fail, fail, fail' => [new NoneOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []],
        ];
    }

    /** @return array<array{NoneOf, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'pass' => [new NoneOf(Stub::pass(1)), []],
            'pass, fail' => [new NoneOf(Stub::pass(1), Stub::fail(1)), []],
            'fail, pass' => [new NoneOf(Stub::fail(1), Stub::pass(1)), []],
            'pass, pass, fail' => [new NoneOf(Stub::pass(1), Stub::pass(1), Stub::fail(1)), []],
            'pass, fail, pass' => [new NoneOf(Stub::pass(1), Stub::fail(1), Stub::pass(1)), []],
            'fail, pass, pass' => [new NoneOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []],
        ];
    }
}
