<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

#[Group('rule')]
#[CoversClass(AbstractComparison::class)]
#[CoversClass(Max::class)]
final class MaxTest extends RuleTestCase
{
    /**
     * @return array<array{Max, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Max(10), 9],
            [new Max(10), 10],
            [new Max('2010-01-01'), '2000-01-01'],
            [new Max(new DateTime('today')), new DateTimeImmutable('yesterday')],
            [new Max('18 years ago'), '1988-09-09'],
            [new Max('z'), 'a'],
            [new Max(new CountableStub(3)), 2],
        ];
    }

    /**
     * @return array<array{Max, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Max(10), 11],
            [new Max(new DateTimeImmutable('today')), new DateTime('tomorrow')],
            [new Max('now'), '+1 minute'],
            [new Max('B'), 'C'],
            [new Max(new CountableStub(3)), 4],
            [new Max(1900), '2018-01-25'],
            [new Max(10.5), '2018-01-25'],
        ];
    }
}
