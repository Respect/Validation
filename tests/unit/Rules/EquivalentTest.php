<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Equivalent::class)]
final class EquivalentTest extends RuleTestCase
{
    /** @return iterable<array{Equivalent, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Equivalent(1), true],
            [new Equivalent('Something'), 'something'],
            [new Equivalent([1, 2, 3]), [1, 2, 3]],
            [new Equivalent((object) ['foo' => 'bar']), (object) ['foo' => 'bar']],
            [new Equivalent(new ArrayObject([1, 2, 3, 4, 5])), new ArrayObject([1, 2, 3, 4, 5])],
        ];
    }

    /** @return iterable<array{Equivalent, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Equivalent(1), false],
            [new Equivalent('Something'), 'something else'],
            [new Equivalent([1, 2, 3]), [1, 2, 3, 4]],
            [new Equivalent((object) ['foo' => 'bar']), (object) ['foo' => 42]],
        ];
    }
}
