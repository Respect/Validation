<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use DateTimeImmutable;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function date;
use function strtotime;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\AbstractAge
 * @covers \Respect\Validation\Rules\MinAge
 */
final class MinAgeTest extends RuleTestCase
{
    /**
     * @return array<array{MinAge, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('18 years ago'))],
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('19 years ago'))],
            [new MinAge(18), '18 years ago'],
            [new MinAge(18), '19 years ago'],
        ];
    }

    /**
     * @return array<array{MinAge, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new MinAge(18), new DateTime('18 years ago')],
            [new MinAge(18), new DateTimeImmutable('19 years ago')],
            [new MinAge(18, 'Y-m-d'), new DateTime('100 years ago')],
            [new MinAge(18, 'Y-m-d'), new DateTimeImmutable('18 years ago')],
            [new MinAge(18, 'Y-m-d'), '100 years ago'],
            [new MinAge(18, 'Y-m-d'), '18 years ago'],
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('17 years ago'))],
            [new MinAge(18), 'invalid-input'],
            [new MinAge(18), new stdClass()],
            [new MinAge(18, 'Y-m-d'), date('Y/m/d', strtotime('18 years ago'))],
            [new MinAge(18, 'Y-m-d'), date('Y-m-d', strtotime('17 years ago'))],
            [new MinAge(18), new DateTime('17 years ago')],
            [new MinAge(18), new DateTimeImmutable('17 years ago')],
            [new MinAge(18), '17 years ago'],
        ];
    }
}
