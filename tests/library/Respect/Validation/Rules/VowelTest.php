<?php
namespace Respect\Validation\Rules;

class VowelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidVowels
     */
    public function testValidDataWithVowelsShouldReturnTrue($validVowels, $aditional='')
    {
        $validator = new Vowel($aditional);
        $this->assertTrue($validator->validate($validVowels));
    }

    /**
     * @dataProvider providerForInvalidVowels
     * @expectedException Respect\Validation\Exceptions\VowelException
     */
    public function testInvalidVowelsShouldFailAndThrowVowelException($invalidVowels, $aditional='')
    {
        $validator = new Vowel($aditional);
        $this->assertFalse($validator->validate($invalidVowels));
        $this->assertFalse($validator->assert($invalidVowels));
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

