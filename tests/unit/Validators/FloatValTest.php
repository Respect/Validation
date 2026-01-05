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

#[Group('validator')]
#[CoversClass(FloatVal::class)]
final class FloatValTest extends RuleTestCase
{
    /** @return iterable<array{FloatVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new FloatVal();

        return [
            [$validator, 165],
            [$validator, 1],
            [$validator, 0],
            [$validator, 0.0],
            [$validator, '1'],
            [$validator, '19347e12'],
            [$validator, 165.0],
            [$validator, '165.7'],
            [$validator, 1e12],
        ];
    }

    /** @return iterable<array{FloatVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new FloatVal();

        return [
            [$validator, ''],
            [$validator, null],
            [$validator, 'a'],
            [$validator, ' '],
            [$validator, 'Foo'],
        ];
    }
}
