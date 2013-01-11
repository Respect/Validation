<?php

namespace Respect\Validation\Rules;

class ConsonantTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidConsonant
     */
    public function testValidDataWithConsonantsShouldReturnTrue($validConsonant, $aditional='')
    {
        $validator = new Consonant($aditional);
        $this->assertTrue($validator->validate($validConsonant));
    }

    /**
     * @dataProvider providerForInvalidConsonant
     * @expectedException Respect\Validation\Exceptions\ConsonantException
     */
    public function testInvalidConsonantsShouldFailAndThrowConsonantException($invalidConsonant, $aditional='')
    {
        $validator = new Consonant($aditional);
        $this->assertFalse($validator->validate($invalidConsonant));
        $this->assertFalse($validator->assert($invalidConsonant));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Consonant($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidConsonant()
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

    public function providerForInvalidConsonant()
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
