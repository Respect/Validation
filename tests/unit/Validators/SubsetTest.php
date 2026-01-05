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
#[CoversClass(Subset::class)]
final class SubsetTest extends RuleTestCase
{
    /** @return iterable<array{Subset, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Subset([]), []],
            [new Subset([1]), [1]],
            [new Subset([1, 1]), [1]],
            [new Subset([1]), [1, 1]],
            [new Subset([2, 1, 3]), [1, 2]],
            [new Subset([1, 2, 3]), [1, 2]],
            [new Subset(['a', 1, 2]), [1]],
        ];
    }

    /** @return iterable<array{Subset, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Subset([]), '1'],
            [new Subset([]), [1]],
            [new Subset([1]), [2]],
            [new Subset([1, 2]), [1, 2, 3]],
            [new Subset(['a', 'b']), ['c']],
        ];
    }
}
