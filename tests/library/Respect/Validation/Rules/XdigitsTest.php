<?php

namespace Respect\Validation\Rules;

class XdigitsTest extends \PHPUnit_Framework_TestCase
{

    protected $xdigitsValidator;

    protected function setUp()
    {
        $this->xdigitsValidator = new Xdigits;
    }

    /**
     * @dataProvider providerForXdigits
     */
    public function testValidateValidHexasdecimalDigits($input)
    {
        $this->assertTrue($this->xdigitsValidator->assert($input));
        $this->assertTrue($this->xdigitsValidator->check($input));
        $this->assertTrue($this->xdigitsValidator->validate($input));
    }

    /**
     * @dataProvider providerForNotXdigits
     * @expectedException Respect\Validation\Exceptions\XdigitsException
     */
    public function testInvalidHexadecimalDigitsShouldThrowXdigitsException($input)
    {
        $this->assertFalse($this->xdigitsValidator->validate($input));
        $this->assertFalse($this->xdigitsValidator->assert($input));
    }

    public function providerForXdigits()
    {
        return array(
            array('FFF'),
            array('15'),
            array('DE12FA'),
            array('1234567890abcdef'),
            array(0x123),
        );
    }

    public function providerForNotXdigits()
    {
        return array(
            array(null),
            array('j'),
            array(' '),
            array('Foo'),
            array(''),
            array('1.5'),
        );
    }

}
