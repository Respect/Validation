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
 * @covers Respect\Validation\Rules\Cntrl
 * @covers Respect\Validation\Exceptions\CntrlException
 */
class CntrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidCntrl
     */
    public function testValidDataWithCntrlShouldReturnTrue($validCntrl, $additional = '')
    {
        $validator = new Cntrl($additional);
        $this->assertTrue($validator->validate($validCntrl));
    }

    /**
     * @dataProvider providerForInvalidCntrl
     * @expectedException Respect\Validation\Exceptions\CntrlException
     */
    public function testInvalidCntrlShouldFailAndThrowCntrlException($invalidCntrl, $additional = '')
    {
        $validator = new Cntrl($additional);
        $this->assertFalse($validator->validate($invalidCntrl));
        $this->assertFalse($validator->assert($invalidCntrl));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Cntrl($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Cntrl($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array('!@#$%^&*(){} ', '!@#$%^&*(){} '),
            array('[]?+=/\\-_|"\',<>. ', "[]?+=/\\-_|\"',<>. \t \n"),
        );
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass()),
            array(array()),
            array(0x2),
        );
    }

    public function providerForValidCntrl()
    {
        return array(
            array("\n"),
            array("\r"),
            array("\t"),
            array("\n\r\t"),
//            array("\n \n", ' '), TODO Verify this
        );
    }

    public function providerForInvalidCntrl()
    {
        return array(
            array(''),
            array('16-50'),
            array('a'),
            array(' '),
            array('Foo'),
            array('12.1'),
            array('-12'),
            array(-12),
            array('alganet'),
        );
    }
}
