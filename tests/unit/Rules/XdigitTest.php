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
 * @covers Respect\Validation\Rules\Xdigit
 * @covers Respect\Validation\Exceptions\XdigitException
 */
class XdigitTest extends \PHPUnit_Framework_TestCase
{
    protected $xdigitsValidator;

    protected function setUp()
    {
        $this->xdigitsValidator = new Xdigit();
    }

    /**
     * @dataProvider providerForXdigit
     */
    public function testValidateValidHexasdecimalDigits($input)
    {
        $this->assertTrue($this->xdigitsValidator->assert($input));
        $this->assertTrue($this->xdigitsValidator->check($input));
        $this->assertTrue($this->xdigitsValidator->validate($input));
    }

    /**
     * @dataProvider providerForNotXdigit
     * @expectedException Respect\Validation\Exceptions\XdigitException
     */
    public function testInvalidHexadecimalDigitsShouldThrowXdigitException($input)
    {
        $this->assertFalse($this->xdigitsValidator->validate($input));
        $this->assertFalse($this->xdigitsValidator->assert($input));
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Xdigit($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array('!@#$%^&*(){} ', '!@#$%^&*(){} abc 123'),
            array("[]?+=/\\-_|\"',<>. \t\n", "[]?+=/\\-_|\"',<>. \t \n abc 123"),
        );
    }

    public function providerForXdigit()
    {
        return array(
            array('FFF'),
            array('15'),
            array('DE12FA'),
            array('1234567890abcdef'),
            array(0x123),
        );
    }

    public function providerForNotXdigit()
    {
        return array(
            array(''),
            array(null),
            array('j'),
            array(' '),
            array('Foo'),
            array('1.5'),
        );
    }
}
