<?php

namespace Respect\Validation\Rules;

class HexaTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Hexa;
    }

    /**
     * @dataProvider providerForHexa
     *
     */
    public function testHexa($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotHexa
     * @expectedException Respect\Validation\Exceptions\HexaException
     */
    public function testNotHexa($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForHexa()
    {
        return array(
            array('FFF'),
            array('15'),
            array('DE12FA'),
        );
    }

    public function providerForNotHexa()
    {
        return array(
            array(null),
            array('j'),
            array(' '),
            array('Foo'),
            array(''),
        );
    }

}