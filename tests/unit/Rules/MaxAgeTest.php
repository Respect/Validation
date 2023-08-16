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
 *
 * @covers \Respect\Validation\Rules\AbstractAge
 * @covers \Respect\Validation\Rules\MaxAge
 *
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class MaxAgeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        return [
            [new MaxAge(30, 'Y-m-d'), date('Y-m-d', strtotime('30 years ago'))],
            [new MaxAge(30, 'Y-m-d'), date('Y-m-d', strtotime('29 years ago'))],
            [new MaxAge(30), '30 years ago'],
            [new MaxAge(30), '29 years ago'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            [new MaxAge(30), new DateTime('30 years ago')],
            [new MaxAge(30), new DateTime('29 years ago')],
            [new MaxAge(30), new DateTimeImmutable('30 years ago')],
            [new MaxAge(30), new DateTimeImmutable('29 years ago')],
            [new MaxAge(30, 'Y-m-d'), new DateTime('30 years ago')],
            [new MaxAge(30, 'Y-m-d'), new DateTimeImmutable('30 years ago')],
            [new MaxAge(30, 'Y-m-d'), '30 years ago'],
            [new MaxAge(30, 'Y-m-d'), date('Y/m/d', strtotime('30 years ago'))],
            [new MaxAge(30), new DateTime('31 years ago')],
            [new MaxAge(30), new DateTimeImmutable('31 years ago')],
            [new MaxAge(30), '31 years ago'],
            [new MaxAge(30, 'Y-m-d'), date('Y-m-d', strtotime('31 years ago'))],
            [new MaxAge(30), 'invalid-input'],
            [new MaxAge(30), new stdClass()],
        ];
    }
}
