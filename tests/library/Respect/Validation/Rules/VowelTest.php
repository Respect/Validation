<?php
namespace Respect\Validation\Rules;

class VowelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidVowels
     */
    public function testValidDataWithVowelsShouldReturnTrue($validVowels, $additional='')
    {
        $validator = new Vowel($additional);
        $this->assertTrue($validator->validate($validVowels));
    }

    /**
     * @dataProvider providerForInvalidVowels
     * @expectedException Respect\Validation\Exceptions\VowelException
     */
    public function testInvalidVowelsShouldFailAndThrowVowelException($invalidVowels, $additional='')
    {
        $validator = new Vowel($additional);
        $this->assertFalse($validator->validate($invalidVowels));
        $this->assertFalse($validator->assert($invalidVowels));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Vowel($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Vowel($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array('!@#$%^&*(){}', '!@#$%^&*(){} aeo iu'),
            array('[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n aeo iu"),
        );
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

