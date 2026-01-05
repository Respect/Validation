<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayIterator;
use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use const PHP_INT_MAX;

#[Group('validator')]
#[CoversClass(Countable::class)]
final class CountableTest extends RuleTestCase
{
    /** @return iterable<array{Countable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $validator = new Countable();

        return [
            [$validator, []],
            [$validator, new ArrayObject()],
            [$validator, new ArrayIterator()],
        ];
    }

    /** @return iterable<array{Countable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Countable();

        return [
            [$validator, '1'],
            [$validator, 1.0],
            [$validator, new stdClass()],
            [$validator, PHP_INT_MAX],
            [$validator, true],
        ];
    }
}
