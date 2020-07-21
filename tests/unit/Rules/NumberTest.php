<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use stdClass;

use function acos;
use function sqrt;

use const INF;
use const NAN;
use const PHP_INT_MAX;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Number
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ismael Elias <ismael.esq@hotmail.com>
 * @author Vitaliy <reboot.m@gmail.com>
 */
final class NumberTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Number();

        return [
            [$rule, '42'],
            [$rule, 123456],
            [$rule, 0.00000000001],
            [$rule, '0.5'],
            [$rule, PHP_INT_MAX],
            [$rule, -PHP_INT_MAX],
            [$rule, INF],
            [$rule, -INF],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Number();

        return [
            [$rule, acos(1.01)],
            [$rule, sqrt(-1)],
            [$rule, NAN],
            [$rule, -NAN],
            [$rule, false],
            [$rule, true],
            [$rule, []],
            [$rule, new stdClass()],
        ];
    }
}
