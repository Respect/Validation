<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

#[Group('rule')]
#[CoversClass(IterableType::class)]
final class IterableTypeTest extends RuleTestCase
{
    /** @return iterable<array{IterableType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $rule = new IterableType();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new stdClass()],
            [$rule, new ArrayIterator()],
        ];
    }

    /** @return iterable<array{IterableType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $rule = new IterableType();

        return [
            [$rule, 3],
            [$rule, 'asdf'],
            [$rule, 9.85],
            [$rule, null],
            [$rule, true],
        ];
    }
}
