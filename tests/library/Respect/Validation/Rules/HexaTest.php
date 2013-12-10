<?php
namespace Respect\Validation\Rules;

class HexaTest extends \PHPUnit_Framework_TestCase
{
    protected $hexaValidator;

    protected function setUp()
    {
        set_error_handler(function () { }, E_USER_DEPRECATED);
        $this->hexaValidator = new Hexa;
    }

    protected function tearDown()
    {
        restore_error_handler();
    }

    /**
     * @dataProvider providerForHexa
     */
    public function testValidateValidHexadecimalNumbers($input)
    {
        $this->assertTrue($this->hexaValidator->assert($input));
        $this->assertTrue($this->hexaValidator->check($input));
        $this->assertTrue($this->hexaValidator->__invoke($input));
    }

    /**
     * @dataProvider providerForNotHexa
     * @expectedException Respect\Validation\Exceptions\HexaException
     */
    public function testInvalidHexadecimalNumbersShouldThrowHexaException($input)
    {
        $this->assertFalse($this->hexaValidator->__invoke($input));
        $this->assertFalse($this->hexaValidator->assert($input));
    }

    public function providerForHexa()
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

    public function providerForNotHexa()
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

