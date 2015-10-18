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
 * @covers Respect\Validation\Rules\ArrayType
 */
class ArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    public function providerForValidArrayType()
    {
        return array(
            array(array())
        );
    }

    /**
     * @dataProvider providerForValidArrayType
     */
    public function testShouldValidateInputWhenItIsAValidArrayType($input)
    {
        $rule = new ArrayType();

        $this->assertTrue($rule->validate($input));
    }

    public function providerForInvalidArrayType()
    {
        return array(
            array('test'),
            array(1),
            array(1.0),
            array(true),
            array(new \ArrayObject()),
        );
    }

    /**
     * @dataProvider providerForInvalidArrayType
     */
    public function testShouldInvalidateInputWhenItIsNotAValidArrayType($input)
    {
        $rule = new ArrayType();

        $this->assertFalse($rule->validate($input));
    }
}
