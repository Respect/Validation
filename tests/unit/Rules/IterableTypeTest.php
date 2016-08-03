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
 * @covers Respect\Validation\Rules\IterableType
 */
class IterableTest extends RuleTestCase
{
    public function providerForValidInput()
    {
        $rule = new IterableType();

        return [
            [$rule, [1, 2, 3]],
            [$rule, new \stdClass()],
            [$rule, new \ArrayIterator()],
        ];
    }

    public function providerForInvalidInput()
    {
        $rule = new IterableType();

        return [
            [$rule, 3],
            [$rule, 'asdf'],
            [$rule, 9.85],
            [$rule, null],
            [$rule, true],
        ];
    }
}
