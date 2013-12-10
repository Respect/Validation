<?php
namespace Respect\Validation\Rules;

class ConsonantTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidConsonants
     */
    public function testValidDataWithConsonantsShouldReturnTrue($validConsonants, $additional='')
    {
        $validator = new Consonant($additional);
        $this->assertTrue($validator->validate($validConsonants));
    }

    /**
     * @dataProvider providerForInvalidConsonants
     * @expectedException Respect\Validation\Exceptions\ConsonantException
     */
    public function testInvalidConsonantsShouldFailAndThrowConsonantException($invalidConsonants, $additional='')
    {
        $validator = new Consonant($additional);
        $this->assertFalse($validator->validate($invalidConsonants));
        $this->assertFalse($validator->assert($invalidConsonants));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Consonant($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Consonant($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array('!@#$%^&*(){}', '!@#$%^&*(){} bc dfg'),
            array('[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n bc dfg"),
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

    public function providerForValidConsonants()
    {
        return array(
            array(''),
            array('b'),
            array('c'),
            array('d'),
            array('w'),
            array('y'),
            array('y',''),
            array('bcdfghklmnp'),
            array('bcdfghklm np'),
            array('qrst'),
            array("\nz\t"),
            array('zbcxwyrspq'),
        );
    }

    public function providerForInvalidConsonants()
    {
        return array(
            array(null),
            array('16'),
            array('aeiou'),
            array('a'),
            array('Foo'),
            array(-50),
            array('basic'),
        );
    }
}

