<?php

namespace Respect\Validation\Rules;

class NumericTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Numeric;
    }

    /**
     * @dataProvider providerForNumeric
     *
     */
    public function testNumeric($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotNumeric
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testNotNumeric($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForNumeric()
    {
        return array(
            array(165),
            array(165.0),
            array(-165),
            array('165'),
            array('165.0'),
            array('+165.0'),
        );
    }

    public function providerForNotNumeric()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
        );
    }

}