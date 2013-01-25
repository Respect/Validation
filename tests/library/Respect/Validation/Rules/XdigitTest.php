<?php
namespace Respect\Validation\Rules;

class XdigitTest extends \PHPUnit_Framework_TestCase
{
    protected $xdigitsValidator;

    protected function setUp()
    {
        $this->xdigitsValidator = new Xdigit;
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

    public function providerForXdigit()
    {
        return array(
            array(''),
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
            array(null),
            array('j'),
            array(' '),
            array('Foo'),
            array('1.5'),
        );
    }
}

