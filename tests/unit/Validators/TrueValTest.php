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
#[CoversClass(TrueVal::class)]
final class TrueValTest extends RuleTestCase
{
    /** @return iterable<array{TrueVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new TrueVal();

        return [
            [$validator, true],
            [$validator, 1],
            [$validator, '1'],
            [$validator, 'true'],
            [$validator, 'on'],
            [$validator, 'yes'],
            [$validator, 'TRUE'],
            [$validator, 'ON'],
            [$validator, 'YES'],
            [$validator, 'True'],
            [$validator, 'On'],
            [$validator, 'Yes'],
        ];
    }

    /** @return iterable<array{TrueVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new TrueVal();

        return [
            [$validator, false],
            [$validator, 0],
            [$validator, 0.5],
            [$validator, 2],
            [$validator, '0'],
            [$validator, 'false'],
            [$validator, 'off'],
            [$validator, 'no'],
            [$validator, 'truth'],
        ];
    }
}
