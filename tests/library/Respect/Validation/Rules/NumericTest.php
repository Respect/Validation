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
     * @expectedException Respect\Validation\Exceptions\NotNumericException
     */
    public function testNotNumeric()
    {
        $this->assertTrue($this->object->assert('w poiur'));
    }

}