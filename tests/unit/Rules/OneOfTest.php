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
#[CoversClass(OneOf::class)]
final class OneOfTest extends RuleTestCase
{
    /** @return array<array{OneOf, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'pass' => [new OneOf(Stub::pass(1)), []],
            'fail, pass' => [new OneOf(Stub::fail(1), Stub::pass(1)), []],
            'pass, fail' => [new OneOf(Stub::pass(1), Stub::fail(1)), []],
            'pass, fail, fail' => [new OneOf(Stub::pass(1), Stub::fail(1), Stub::fail(1)), []],
            'fail, pass, fail' => [new OneOf(Stub::fail(1), Stub::pass(1), Stub::fail(1)), []],
            'fail, fail, pass' => [new OneOf(Stub::fail(1), Stub::fail(1), Stub::pass(1)), []],
        ];
    }

    /** @return array<array{OneOf, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'fail' => [new OneOf(Stub::fail(1)), []],
            'fail, fail' => [new OneOf(Stub::fail(1), Stub::fail(1)), []],
            'fail, fail, fail' => [new OneOf(Stub::fail(1), Stub::fail(1), Stub::fail(1)), []],
            'fail, pass, pass' => [new OneOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []],
        ];
    }
}
