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

/**
 * @group  rule
 * @covers Respect\Validation\Rules\Imei
 */
class ImeiTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new Imei();

        return [
            [$rule, '35-007752-323751-3'],
            [$rule, '35-209900-176148-1'],
            [$rule, '350077523237513'],
            [$rule, '356938035643809'],
            [$rule, '490154203237518'],
            [$rule, 350077523237513],
            [$rule, 356938035643809],
            [$rule, 490154203237518],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new Imei();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 1.0],
            [$rule, new \stdClass()],
            [$rule, '490154203237512'],
            [$rule, '4901542032375125'],
            [$rule, 'Whateveeeeeerrr'],
            [$rule, true],
        ];
    }
}
