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
#[CoversClass(BoolVal::class)]
final class BoolValTest extends RuleTestCase
{
    /** @return iterable<array{BoolVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new BoolVal();

        return [
            [$validator, true],
            [$validator, 1],
            [$validator, 'on'],
            [$validator, 'yes'],
            [$validator, 0],
            [$validator, false],
            [$validator, 'off'],
            [$validator, 'no '],
            [$validator, ''],
        ];
    }

    /** @return iterable<array{BoolVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new BoolVal();

        return [
            [$validator, 'ok'],
            [$validator, 'yep'],
            [$validator, 10],
        ];
    }
}
