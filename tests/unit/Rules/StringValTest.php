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
 * @covers \Respect\Validation\Rules\StringVal
 */
class StringValTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new StringVal();

        return [
            [$rule, '6'],
            [$rule, 'String'],
            [$rule, 1.0],
            [$rule, 42],
            [$rule, false],
            [$rule, true],
            [$rule, new ClassWithToString()],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new StringVal();

        return [
            [$rule, []],
            [$rule, function () {
            }],
            [$rule, new stdClass()],
            [$rule, null],
            [$rule, tmpfile()],
        ];
    }
}

class ClassWithToString
{
    public function __toString()
    {
        return self::class;
    }
}
