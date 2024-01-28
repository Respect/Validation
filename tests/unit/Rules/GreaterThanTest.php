<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

#[Group('rule')]
#[CoversClass(AbstractComparison::class)]
#[CoversClass(GreaterThan::class)]
final class GreaterThanTest extends RuleTestCase
{
    /**
     * @return array<array{GreaterThan, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new GreaterThan(10), 11],
            [new GreaterThan('2010-01-01'), '2020-01-01'],
            [new GreaterThan('yesterday'), 'now'],
            [new GreaterThan('A'), 'B'],
            [new GreaterThan(new CountableStub(3)), 4],
        ];
    }

    /**
     * @return array<array{GreaterThan, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new GreaterThan(10), 9],
            [new GreaterThan('2010-01-01'), '2000-01-01'],
            [new GreaterThan('18 years ago'), '5 days later'],
            [new GreaterThan('c'), 'a'],
            [new GreaterThan(new CountableStub(3)), 3],
            [new GreaterThan(1900), '2018-01-25'],
            [new GreaterThan(10.5), '2018-01-25'],
        ];
    }
}
