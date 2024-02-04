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
#[CoversClass(AllOf::class)]
final class AllOfTest extends RuleTestCase
{
    /** @return array<array{AllOf, mixed}> */
    public static function providerForValidInput(): array
    {
        return [
            'pass' => [new AllOf(Stub::pass(1)), []],
            'pass, pass' => [new AllOf(Stub::pass(1), Stub::pass(1)), []],
        ];
    }

    /** @return array<array{AllOf, mixed}> */
    public static function providerForInvalidInput(): array
    {
        return [
            'fail' => [new AllOf(Stub::fail(1)), []],
            'pass, fail' => [new AllOf(Stub::pass(1), Stub::fail(1)), []],
            'fail, pass' => [new AllOf(Stub::fail(1), Stub::pass(1)), []],
            'pass, pass, fail' => [new AllOf(Stub::pass(1), Stub::pass(1), Stub::fail(1)), []],
            'pass, fail, pass' => [new AllOf(Stub::pass(1), Stub::fail(1), Stub::pass(1)), []],
            'fail, pass, pass' => [new AllOf(Stub::fail(1), Stub::pass(1), Stub::pass(1)), []],
        ];
    }
}
