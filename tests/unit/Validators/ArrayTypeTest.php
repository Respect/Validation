<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use ArrayIterator;
use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group(' rule')]
#[CoversClass(ArrayType::class)]
final class ArrayTypeTest extends RuleTestCase
{
    /** @return iterable<array{ArrayType, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new ArrayType();

        return [
            [$validator, []],
            [$validator, [1, 2, 3]],
        ];
    }

    /** @return iterable<array{ArrayType, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new ArrayType();

        return [
            [$validator, 'test'],
            [$validator, 1],
            [$validator, 1.0],
            [$validator, true],
            [$validator, new ArrayObject()],
            [$validator, new ArrayIterator()],
        ];
    }
}
