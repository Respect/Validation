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
class TldTest extends \PHPUnit_Framework_TestCase
{
    public function providerForValidIntType()
    {
        return array(
            array('com'),
            array('cafe'),
            array('democrat'),
            array('br'),
            array('us'),
            array('eu'),
        );
    }

    /**
     * @dataProvider providerForValidIntType
     */
    public function testShouldValidateInputWhenItIsAValidIntType($input)
    {
        $rule = new Tld();

        $this->assertTrue($rule->validate($input));
    }

    public function providerForInvalidIntType()
    {
        return array(
            array('1'),
            array(1.0),
            array('wrongtld'),
            array(true),
        );
    }

    /**
     * @dataProvider providerForInvalidIntType
     */
    public function testShouldInvalidateInputWhenItIsNotAValidIntType($input)
    {
        $rule = new Tld();

        $this->assertFalse($rule->validate($input));
    }
}
