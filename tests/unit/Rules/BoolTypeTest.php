<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(BoolType::class)]
final class BoolTypeTest extends RuleTestCase
{
    /** @return iterable<array{BoolType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new BoolType();

        return [
            [$rule, true],
            [$rule, false],
        ];
    }

    /** @return iterable<array{BoolType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new BoolType();

        return [
            [$rule, ''],
            [$rule, 'foo'],
            [$rule, 123123],
            [$rule, new stdClass()],
            [$rule, []],
            [$rule, 1],
            [$rule, 0],
            [$rule, null],
        ];
    }
}
