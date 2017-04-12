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
 * @covers \Respect\Validation\Rules\IntType
 */
class IntTypeTest extends \PHPUnit_Framework_TestCase
{
    public function providerForValidIntType()
    {
        return [
            [0],
            [123456],
            [PHP_INT_MAX],
            [PHP_INT_MAX * -1],
        ];
    }

    /**
     * @dataProvider providerForValidIntType
     */
    public function testShouldValidateInputWhenItIsAValidIntType($input)
    {
        $rule = new IntType();

        $this->assertTrue($rule->validate($input));
    }

    public function providerForInvalidIntType()
    {
        return [
            ['1'],
            [1.0],
            [PHP_INT_MAX + 1],
            [true],
        ];
    }

    /**
     * @dataProvider providerForInvalidIntType
     */
    public function testShouldInvalidateInputWhenItIsNotAValidIntType($input)
    {
        $rule = new IntType();

        $this->assertFalse($rule->validate($input));
    }
}
