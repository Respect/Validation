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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Test\RuleTestCase;

#[Group('rule')]
#[CoversClass(Time::class)]
final class TimeTest extends RuleTestCase
{
    #[Test]
    #[DataProvider('invalidFormatsProvider')]
    public function shouldThrowAnExceptionWhenFormatIsNotValid(string $format): void
    {
        $this->expectException(InvalidRuleConstructorException::class);

        new Time($format);
    }

    /** @return mixed[][] */
    public static function invalidFormatsProvider(): array
    {
        return [
            ['Y-m-d H:i:s'],
            ['M g:i A'],
        ];
    }

    /** @return iterable<array{Time, mixed}> */
    public static function providerForValidInput(): iterable
    {
        return [
            [new Time(), '00:00:00'],
            [new Time(), '23:20:59'],
            [new Time('H:i'), '23:59'],
            [new Time('g:i A'), '8:13 AM'],
            [new Time('His'), 232059],
            [new Time('H:i:s.u'), '08:16:01.000000'],
            [new Time('ga'), '3am'],
        ];
    }

    /** @return iterable<array{Time, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        return [
            [new Time(), '00:00:60'],
            [new Time(), '00:60:00'],
            [new Time(), '24:00:00'],
            [new Time(), '00:00'],
            [new Time(), new DateTime()],
            [new Time(), new DateTimeImmutable()],
            [new Time(), ''],
        ];
    }
}
