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
#[CoversClass(Undef::class)]
final class UndefTest extends RuleTestCase
{
    /** @return iterable<array{Undef, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Undef();

        return [
            [$validator, []],
            [$validator, ' '],
            [$validator, 0],
            [$validator, '0'],
            [$validator, 0],
            [$validator, '0.0'],
            [$validator, false],
            [$validator, ['']],
            [$validator, [' ']],
            [$validator, [0]],
            [$validator, ['0']],
            [$validator, [false]],
            [$validator, [[''], [0]]],
            [$validator, new stdClass()],
        ];
    }

    /** @return iterable<array{Undef, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Undef();

        return [
            [$validator, null],
            [$validator, ''],
        ];
    }
}
