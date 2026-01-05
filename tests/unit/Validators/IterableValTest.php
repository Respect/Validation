<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayIterator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('validator')]
#[CoversClass(IterableVal::class)]
final class IterableValTest extends RuleTestCase
{
    /** @return iterable<array{IterableVal, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new IterableVal();

        return [
            [$validator, [1, 2, 3]],
            [$validator, new stdClass()],
            [$validator, new ArrayIterator()],
        ];
    }

    /** @return iterable<array{IterableVal, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new IterableVal();

        return [
            [$validator, 3],
            [$validator, 'asdf'],
            [$validator, 9.85],
            [$validator, null],
            [$validator, true],
        ];
    }
}
