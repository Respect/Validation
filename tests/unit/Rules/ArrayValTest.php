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
 * @covers Respect\Validation\Exceptions\ArrayValException
 */
class ArrayValTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerValidArrayData
     */
    public function testValidArrayOrArrayObjectShouldReturnTrue($input)
    {
        $arrayVal = new ArrayVal();
        $this->assertTrue($arrayVal->validate($input));
    }

    /**
     * @dataProvider providerInvalidArrayData
     */
    public function testInvalidArgumentShouldReturnFalse($input)
    {
        $arrayVal = new ArrayVal();
        $this->assertFalse($arrayVal->validate($input));
    }

    public function providerValidArrayData()
    {
        return array(
            array(array(1, 2, 3)),
            array(new \ArrayObject()),
        );
    }

    public function providerInvalidArrayData()
    {
        return array(
            array(''),
            array(null),
            array(121),
            array(new \stdClass()),
            array(false),
            array('aaa'),
        );
    }
}
