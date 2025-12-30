<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\CountableStub;

#[Group('rule')]
#[CoversClass(LessThanOrEqual::class)]
final class LessThanOrEqualTest extends RuleTestCase
{
    /** @return iterable<array{LessThanOrEqual, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new LessThanOrEqual(10), 9],
            [new LessThanOrEqual(10), 10],
            [new LessThanOrEqual('2010-01-01'), '2000-01-01'],
            [new LessThanOrEqual(new DateTime('today')), new DateTimeImmutable('yesterday')],
            [new LessThanOrEqual('18 years ago'), '1988-09-09'],
            [new LessThanOrEqual('z'), 'a'],
            [new LessThanOrEqual(new CountableStub(3)), 2],
        ];
    }

    /** @return iterable<array{LessThanOrEqual, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new LessThanOrEqual(10), 11],
            [new LessThanOrEqual(new DateTimeImmutable('today')), new DateTime('tomorrow')],
            [new LessThanOrEqual('now'), '+1 minute'],
            [new LessThanOrEqual('B'), 'C'],
            [new LessThanOrEqual(new CountableStub(3)), 4],
            [new LessThanOrEqual(1900), '2018-01-25'],
            [new LessThanOrEqual(10.5), '2018-01-25'],
        ];
    }
}
