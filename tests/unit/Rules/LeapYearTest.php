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
 * @covers \Respect\Validation\Rules\LeapYear
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jayson Reis <santosdosreis@gmail.com>
 */
final class LeapYearTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new LeapYear();

        return [
            [$rule, '2008'],
            [$rule, '2008-02-29'],
            [$rule, 2008],
            [$rule, 2008],
            [$rule, new DateTime('2008-02-29')],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new LeapYear();

        return [
            [$rule, ''],
            [$rule, '2009'],
            [$rule, '2009-02-29'],
            [$rule, 2009],
            [$rule, new DateTime('2009-02-29')],
            [$rule, []],
        ];
    }
}
