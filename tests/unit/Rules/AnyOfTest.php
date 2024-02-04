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
    /** @return array<array{AnyOf, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'pass' => [new AnyOf(Stub::pass(1)), []],
            'fail, pass' => [new AnyOf(Stub::fail(1), Stub::pass(1)), []],
            'fail, fail, pass' => [new AnyOf(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []],
            'fail, pass, fail' => [new AnyOf(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []],
        ];
    }

    /** @return array<array{AnyOf, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'fail' => [new AnyOf(Stub::fail(1)), []],
            'fail, fail' => [new AnyOf(Stub::fail(1), Stub::fail(1)), []],
            'fail, fail, fail' => [new AnyOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []],
        ];
    }
}
