<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Number
 */
class NumberTest extends RuleTestCase
{
    public function providerForValidInput()
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

    public function providerForInvalidInput()
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
