<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

#[Group('validator')]
#[CoversClass(GreaterThanOrEqual::class)]
final class GreaterThanOrEqualTest extends RuleTestCase
{
    /** @return iterable<array{GreaterThanOrEqual, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            // From documentation
            [new GreaterThanOrEqual(10), 10],
            [new GreaterThanOrEqual(10), 11],
            [new GreaterThanOrEqual('2010-01-01'), '2010-01-01'],
            [new GreaterThanOrEqual(new DateTime('yesterday')), new DateTimeImmutable('tomorrow')],
            [new GreaterThanOrEqual('1988-09-09'), '18 years ago'],
            [new GreaterThanOrEqual('a'), 'b'],

            [new GreaterThanOrEqual(100), 165.0],
            [new GreaterThanOrEqual(-100), 200],
            [new GreaterThanOrEqual(200), 200],
            [new GreaterThanOrEqual(200), 300],
            [new GreaterThanOrEqual('a'), 'a'],
            [new GreaterThanOrEqual('a'), 'c'],
            [new GreaterThanOrEqual('yesterday'), 'now'],
            // Samples from issue #178
            [new GreaterThanOrEqual('13-05-2014 03:16'), '20-05-2014 03:16'],
            [new GreaterThanOrEqual(new DateTime('13-05-2014 03:16')), new DateTime('20-05-2014 03:16')],
            [new GreaterThanOrEqual('13-05-2014 03:16'), new DateTime('20-05-2014 03:16')],
            [new GreaterThanOrEqual(new DateTime('13-05-2014 03:16')), '20-05-2014 03:16'],
            [new GreaterThanOrEqual(50), 50],
            [new GreaterThanOrEqual(new CountableStub(10)), 10],
        ];
    }

    /** @return iterable<array{GreaterThanOrEqual, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            // From documentation
            [new GreaterThanOrEqual(10), 9],
            [new GreaterThanOrEqual('2011-01-01'), '2009-01-01'],
            [new GreaterThanOrEqual(new DateTimeImmutable('+1 month')), new DateTime('today')],
            [new GreaterThanOrEqual('+1 minute'), new DateTime('now')],
            [new GreaterThanOrEqual('C'), 'A'],

            [new GreaterThanOrEqual(100), ''],
            [new GreaterThanOrEqual(100), ''],
            [new GreaterThanOrEqual(500), 300],
            [new GreaterThanOrEqual(0), -250],
            [new GreaterThanOrEqual(0), -50],
            [new GreaterThanOrEqual(new CountableStub(1)), 0],
            [new GreaterThanOrEqual(2040), '2018-01-25'],
            [new GreaterThanOrEqual(10.5), '2018-01-25'],
        ];
    }
}
