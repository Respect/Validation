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

#[Group('validator')]
#[CoversClass(Odd::class)]
final class OddTest extends RuleTestCase
{
    /** @return iterable<array{Odd, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Odd();

        return [
            [$validator, -5],
            [$validator, -1],
            [$validator, 1],
            [$validator, 13],
        ];
    }

    /** @return iterable<array{Odd, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Odd();

        return [
            [$validator, []],
            [$validator, new stdClass()],
            [$validator, tmpfile()],
            [$validator, true],
            [$validator, false],
            [$validator, ''],
            [$validator, -2],
            [$validator, -0],
            [$validator, 0],
            [$validator, 32],
        ];
    }
}
