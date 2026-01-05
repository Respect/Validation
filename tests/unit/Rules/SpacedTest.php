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
#[CoversClass(Spaced::class)]
final class SpacedTest extends RuleTestCase
{
    /** @return iterable<array{Spaced, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Spaced();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 0],
            [$validator, 'wpoiur'],
            [$validator, 'Foo'],
            [$validator, []],
            [$validator, new stdClass()],
        ];
    }

    /** @return iterable<array{Spaced, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Spaced();

        return [
            [$validator, ' '],
            [$validator, 'w poiur'],
            [$validator, '      '],
            [$validator, "Foo\nBar"],
            [$validator, "Foo\tBar"],
        ];
    }
}
