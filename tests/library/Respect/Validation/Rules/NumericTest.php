<?php

namespace Respect\Validation\Rules;

class NumericTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Numeric;
    }

    public function testNumeric()
    {
        $this->assertTrue($this->object->assert(165));
    }

    /**
     * @dataProvider providerForNotNumeric
     * @expectedException Respect\Validation\Exceptions\NotNumericException
     */
    public function testNotNumeric($input)
    {
        $this->assertTrue($this->object->assert($input));
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