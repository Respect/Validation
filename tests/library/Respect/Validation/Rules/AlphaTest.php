<?php

namespace Respect\Validation\Rules;

class AlphaTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidAlpha
     */
    public function test_valid_alphanumeric_chars_should_return_true($validAlpha, $aditional)
    {
        $validator = new Alpha($aditional);
        $this->assertTrue($validator->validate($validAlpha));
        $this->assertTrue($validator->check($validAlpha));
        $this->assertTrue($validator->assert($validAlpha));
    }

    /**
     * @dataProvider providerForInvalidAlpha
     * @expectedException Respect\Validation\Exceptions\AlphaException
     */
    public function test_invalid_alphanumeric_chars_should_throw_AlphaException($invalidAlpha, $aditional)
    {
        $validator = new Alpha($aditional);
        $this->assertFalse($validator->validate($invalidAlpha));
        $this->assertFalse($validator->assert($invalidAlpha));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function test_invalid_constructor_params_should_throw_ComponentExeption($aditional)
    {
        $validator = new Alpha($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidAlpha()
    {
        return array(
            array('alganet', ''),
            array('alganet', 'alganet'),
            array('0alg-anet0', '0-9'),
            array('a', ''),
            array('', ''),
            array("\t", ''),
            array("\n", ''),
            array('foobar', ''),
            array('rubinho_', '_'),
            array('google.com', '.'),
            array('alganet alganet', ''),
            array("\nabc", ''),
            array("\tdef", ''),
            array("\nabc \t", ''),
        );
    }

    public function providerForInvalidAlpha()
    {
        return array(
            array('@#$', ''),
            array('_', ''),
            array('dgç', ''),
            array('122al', ''),
            array('122', ''),
            array(11123, ''),
            array(1e21, ''),
            array(0, ''),
            array(null, ''),
            array(new \stdClass, ''),
            array(array(), ''),
        );
    }

}
