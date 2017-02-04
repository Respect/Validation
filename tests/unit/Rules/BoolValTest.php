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
 * @covers \Respect\Validation\Rules\BoolVal
 */
class BoolValTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new BoolVal();

        return [
            [$rule, true],
            [$rule, 1],
            [$rule, 'on'],
            [$rule, 'yes'],
            [$rule, 0],
            [$rule, false],
            [$rule, 'off'],
            [$rule, 'no '],
            [$rule, ''],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new BoolVal();

        return [
            [$rule, 'ok'],
            [$rule, 'yep'],
            [$rule, 10],
        ];
    }
}
