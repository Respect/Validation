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

#[Group('validator')]
#[CoversClass(BoolType::class)]
final class BoolTypeTest extends RuleTestCase
{
    /** @return iterable<array{BoolType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new BoolType();

        return [
            [$validator, true],
            [$validator, false],
        ];
    }

    /** @return iterable<array{BoolType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new BoolType();

        return [
            [$validator, ''],
            [$validator, 'foo'],
            [$validator, 123123],
            [$validator, new stdClass()],
            [$validator, []],
            [$validator, 1],
            [$validator, 0],
            [$validator, null],
        ];
    }
}
