<?php

namespace Respect\Validation\Rules;

class VowelsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidVowels
     */
    public function test_valid_data_with_vowels_should_return_true($validVowels, $aditional='')
    {
        $validator = new Vowels($aditional);
        $this->assertTrue($validator->validate($validVowels));
    }

    /**
     * @dataProvider providerForInvalidVowels
     * @expectedException Respect\Validation\Exceptions\VowelsException
     */
    public function test_invalid_vowels_should_fail_and_throw_VowelsException($invalidVowels, $aditional='')
    {
        $validator = new Vowels($aditional);
        $this->assertFalse($validator->validate($invalidVowels));
        $this->assertFalse($validator->assert($invalidVowels));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function test_invalid_constructor_params_should_throw_ComponentException_upon_instantiation($aditional)
    {
        $validator = new Vowels($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidVowels()
    {
        return array(
            array(''),
            array('a'),
            array('e'),
            array('i'),
            array('o'),
            array('u'),
            array('aeiou'),
            array('aei ou'),
            array("\na\t"),
            array('uoiea'),
        );
    }

    public function providerForInvalidVowels()
    {
        return array(
            array(null),
            array('16'),
            array('F'),
            array('g'),
            array('Foo'),
            array(-50),
            array('basic'),
        );
    }

}
