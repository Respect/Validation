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
#[CoversClass(Blank::class)]
final class BlankTest extends RuleTestCase
{
    /** @return iterable<array{Blank, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $object = new stdClass();
        $object->foo = true;

        $validator = new Blank();

        return [
            [$validator, 1],
            [$validator, ' oi'],
            [$validator, [5]],
            [$validator, [1]],
            [$validator, $object],
        ];
    }

    /** @return iterable<array{Blank, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Blank();

        return [
            [$validator, null],
            [$validator, ''],
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
}
