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

#[Group('validator')]
#[CoversClass(NullType::class)]
final class NullTypeTest extends RuleTestCase
{
    /** @return iterable<array{NullType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new NullType();

        return [
            [$validator, null],
        ];
    }

    /** @return iterable<array{NullType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new NullType();

        return [
            [$validator, ''],
            [$validator, false],
            [$validator, []],
            [$validator, 0],
            [$validator, 'w poiur'],
        ];
    }
}
