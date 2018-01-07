<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\ArrayType
 */
class ArrayTypeTest extends RuleTestCase

{
    public function providerForValidInput(): array
    {
        $rule = new ArrayType();

        return [
            [$rule, []],
            [$rule, [1, 2, 3]],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new ArrayType();

        return [
            [$rule, 'test'],
            [$rule, 1],
            [$rule, 1.0],
            [$rule, true],
            [$rule, new \ArrayObject()],
            [$rule, new \ArrayIterator()],
        ];
    }
}
