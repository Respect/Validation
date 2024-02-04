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

use function tmpfile;

#[Group('rule')]
#[CoversClass(Odd::class)]
final class OddTest extends RuleTestCase
{
    /** @return iterable<array{Odd, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new Odd();

        return [
            [$rule, -5],
            [$rule, -1],
            [$rule, 1],
            [$rule, 13],
        ];
    }

    /** @return iterable<array{Odd, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new Odd();

        return [
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, tmpfile()],
            [$rule, true],
            [$rule, false],
            [$rule, ''],
            [$rule, -2],
            [$rule, -0],
            [$rule, 0],
            [$rule, 32],
        ];
    }
}
