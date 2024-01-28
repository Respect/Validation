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

#[Group('rule')]
#[CoversClass(Countable::class)]
final class CountableTest extends RuleTestCase
{
    /**
     * @return array<array{Countable, mixed}>
     */
    public static function providerForValidInput(): array
    {
        $rule = new Countable();

        return [
            [$rule, []],
            [$rule, new ArrayObject()],
            [$rule, new ArrayIterator()],
        ];
    }

    /**
     * @return array<array{Countable, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Countable();

        return [
            [$rule, '1'],
            [$rule, 1.0],
            [$rule, new stdClass()],
            [$rule, PHP_INT_MAX],
            [$rule, true],
        ];
    }
}
