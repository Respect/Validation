<?php

namespace Respect\Validation\Rules;

class VowelTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidVowel
     */
    public function testValidDataWithVowelsShouldReturnTrue($validVowel, $aditional='')
    {
        $validator = new Vowel($aditional);
        $this->assertTrue($validator->validate($validVowel));
    }

    /**
     * @dataProvider providerForInvalidVowel
     * @expectedException Respect\Validation\Exceptions\VowelException
     */
    public function testInvalidVowelsShouldFailAndThrowVowelsException($invalidVowel, $aditional='')
    {
        $validator = new Vowel($aditional);
        $this->assertFalse($validator->validate($invalidVowel));
        $this->assertFalse($validator->assert($invalidVowel));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Vowel($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidVowel()
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

    public function providerForInvalidVowel()
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
