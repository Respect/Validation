<?php
namespace Respect\Validation\Rules;

class AlnumTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForValidAlnum
     */
    public function testValidAlnumCharsShouldReturnTrue($validAlnum, $additional)
    {
        $validator = new Alnum($additional);
        $this->assertTrue($validator->validate($validAlnum));
        $this->assertTrue($validator->check($validAlnum));
        $this->assertTrue($validator->assert($validAlnum));
    }

    /**
     * @dataProvider providerForInvalidAlnum
     * @expectedException Respect\Validation\Exceptions\AlnumException
     */
    public function testInvalidAlnumCharsShouldThrowAlnumExceptionAndReturnFalse($invalidAlnum, $additional)
    {
        $validator = new Alnum($additional);
        $this->assertFalse($validator->validate($invalidAlnum));
        $this->assertFalse($validator->assert($invalidAlnum));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($additional)
    {
        $validator = new Alnum($additional);
    }

    /**
     * @dataProvider providerAdditionalChars
     */
    public function testAdditionalCharsShouldBeRespected($additional, $query)
    {
        $validator = new Alnum($additional);
        $this->assertTrue($validator->validate($query));
    }

    public function providerAdditionalChars()
    {
        return array(
            array('!@#$%^&*(){}', '!@#$%^&*(){} abc 123'),
            array('[]?+=/\\-_|"\',<>.', "[]?+=/\\-_|\"',<>. \t \n abc 123"),
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

    public function providerForValidAlnum()
    {
        return array(
            array('', ''),
            array('alganet', ''),
            array('alganet', 'alganet'),
            array('0alg-anet0', '0-9'),
            array('1', ''),
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

