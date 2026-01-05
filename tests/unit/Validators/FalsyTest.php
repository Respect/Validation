<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(Falsy::class)]
final class FalsyTest extends RuleTestCase
{
    /** @return iterable<array{Falsy, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Falsy();

        return [
            [$validator, 1],
            [$validator, ' oi'],
            [$validator, [5]],
            [$validator, [0]],
            [$validator, new stdClass()],
            [$validator, '    '],
            [$validator, "\n"],
        ];
    }

    /** @return iterable<array{Falsy, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Falsy();

        return [
            [$validator, ''],
            [$validator, false],
            [$validator, null],
            [$validator, []],
        ];
    }
}
