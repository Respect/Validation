<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use DateTime;
use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\LeapDate
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapDateTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new LeapDate('Y-m-d'), '1988-02-29'],
            [new LeapDate('Y-m-d'), '1992-02-29'],
            [new LeapDate('Y-m-d'), new DateTime('1988-02-29')],
            [new LeapDate('Y-m-d'), new DateTime('1992-02-29')],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new LeapDate('Y-m-d'), '1989-02-29'],
            [new LeapDate('Y-m-d'), '1993-02-29'],
            [new LeapDate('Y-m-d'), new DateTime('1989-02-29')],
            [new LeapDate('Y-m-d'), new DateTime('1993-02-29')],
            [new LeapDate('Y-m-d'), []],
        ];
    }
}
