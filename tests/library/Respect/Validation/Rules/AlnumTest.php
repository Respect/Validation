<?php

namespace Respect\Validation\Rules;

class AlnumTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidAlnum
     */
    public function test_valid_alnum_chars_should_return_true($validAlnum, $aditional)
    {
        $validator = new Alnum($aditional);
        $this->assertTrue($validator->validate($validAlnum));
        $this->assertTrue($validator->check($validAlnum));
        $this->assertTrue($validator->assert($validAlnum));
    }

    /**
     * @dataProvider providerForInvalidAlnum
     * @expectedException Respect\Validation\Exceptions\AlnumException
     */
    public function test_invalid_alnum_chars_should_throw_AlnumException_and_return_false($invalidAlnum, $aditional)
    {
        $validator = new Alnum($aditional);
        $this->assertFalse($validator->validate($invalidAlnum));
        $this->assertFalse($validator->assert($invalidAlnum));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function test_invalid_constructor_params_should_throw_ComponentException_upon_instantiation($aditional)
    {
        $validator = new Alnum($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidAlnum()
    {
        return array(
            array('alganet', ''),
            array('alganet', 'alganet'),
            array('0alg-anet0', '0-9'),
            array('1', ''),
            array('', ''),
            array("\t", ''),
            array("\n", ''),
            array('a', ''),
            array('foobar', ''),
            array('rubinho_', '_'),
            array('google.com', '.'),
            array('alganet alganet', ''),
            array("\nabc", ''),
            array("\tdef", ''),
            array("\nabc \t", ''),
            array(0, ''),
        );
    }

    public function providerForInvalidAlnum()
    {
        return array(
            array('@#$', ''),
            array('_', ''),
            array('dgç', ''),
            array(1e21, ''), //evaluates to "1.0E+21"
            array(null, ''),
            array(new \stdClass, ''),
            array(array(), ''),
        );
    }

}
