<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function acos;
use function sqrt;

use const NAN;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Decimal
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ismael Elias <ismael.esq@hotmail.com>
 * @author Vitaliy <reboot.m@gmail.com>
 */
final class DecimalTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        return [
            [new Decimal(0), 1],
            [new Decimal(1), 1.0],
            [new Decimal(2), 1.00],
            [new Decimal(3), 1.000],
            [new Decimal(2), 1.000],
            [new Decimal(1), 1.000],
            [new Decimal(2), '27990.50'],
            [new Decimal(1), 1.1],
            [new Decimal(1), '1.3'],
            [new Decimal(1), 1.50],
            [new Decimal(1), 10.0],
            [new Decimal(2), 10.00],
            [new Decimal(1), 10.50],
            [new Decimal(2), 10.50],
            [new Decimal(3), '1.000'],
            [new Decimal(3), 123456789.001],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        return [
            [new Decimal(1), '1.50'],
            [new Decimal(1), '27990.50'],
            [new Decimal(0), 2.0],
            [new Decimal(0), acos(1.01)],
            [new Decimal(0), sqrt(-1)],
            [new Decimal(0), NAN],
            [new Decimal(0), -NAN],
            [new Decimal(0), false],
            [new Decimal(0), true],
            [new Decimal(0), []],
            [new Decimal(0), new stdClass()],
        ];
    }
}
