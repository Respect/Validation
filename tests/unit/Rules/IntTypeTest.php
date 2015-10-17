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
 * @covers Respect\Validation\Rules\IntType
 */
class IntTypeTest extends \PHPUnit_Framework_TestCase
{
    public function providerForValidIntType()
    {
        return array(
            array(0),
            array(123456),
            array(PHP_INT_MAX),
            array(PHP_INT_MAX * -1),
        );
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
        return array(
            array('1'),
            array(1.0),
            array(PHP_INT_MAX + 1),
            array(true),
        );
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
