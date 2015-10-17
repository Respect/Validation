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
 * @covers Respect\Validation\Rules\ArrayVal
 */
class ArrayValTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new ArrayVal();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
            [$rule, new \ArrayObject()],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new ArrayVal();

        return [
            [$rule, ''],
            [$rule, null],
            [$rule, 121],
            [$rule, new \stdClass()],
            [$rule, false],
            [$rule, 'aaa'],
        ];
    }
}
