<?php

namespace Respect\Validation\Rules;

class GraphicalTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidGraphical
     */
    public function testValidDataWithGraphicalCharsShouldReturnTrue($validGraphical, $aditional='')
    {
        $validator = new Graphical($aditional);
        $this->assertTrue($validator->validate($validGraphical));
    }

    /**
     * @dataProvider providerForInvalidGraphical
     * @expectedException Respect\Validation\Exceptions\GraphicalException
     */
    public function testInvalidGraphicalShouldFailAndThrowGraphicalException($invalidGraphical, $aditional='')
    {
        $validator = new Graphical($aditional);
        $this->assertFalse($validator->validate($invalidGraphical));
        $this->assertFalse($validator->assert($invalidGraphical));
    }

    /**
     * @dataProvider providerForInvalidParams
     * @expectedException Respect\Validation\Exceptions\ComponentException
     */
    public function testInvalidConstructorParamsShouldThrowComponentExceptionUponInstantiation($aditional)
    {
        $validator = new Graphical($aditional);
    }

    public function providerForInvalidParams()
    {
        return array(
            array(new \stdClass),
            array(array()),
            array(0x2)
        );
    }

    public function providerForValidGraphical()
    {
        return array(
            array(''),
            array('LKA#@%.54'),
            array('foobar'),
            array('16-50'),
            array('123'),
            array('#$%&*_'),
        );
    }

    public function providerForInvalidGraphical()
    {
        return array(
            array(null),
            array("foo\nbar"),
            array("foo\tbar"),
            array('foo bar'),
            array(' '),
        );
    }

}
