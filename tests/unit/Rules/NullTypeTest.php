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

#[Group('rule')]
#[CoversClass(NullType::class)]
final class NullTypeTest extends RuleTestCase
{
    /** @return iterable<array{NullType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new NullType();

        return [
            [$rule, null],
        ];
    }

    /** @return iterable<array{NullType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new NullType();

        return [
            [$rule, ''],
            [$rule, false],
            [$rule, []],
            [$rule, 0],
            [$rule, 'w poiur'],
        ];
    }
}
