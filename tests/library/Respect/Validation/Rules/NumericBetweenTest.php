<?php

namespace Respect\Validation\Rules;

class NumericBetweenTest extends \PHPUnit_Framework_TestCase
{
    
    public function providerValid()
    {
        return array(
            array(0,1,0),
            array(0,1,1),
            array(10,20,15),
            array(10,20,20),
            array(-10,20,-5),
            array(-10,20,0),
        );
    }
    
    public function providerInvalid() {
        return array(
            array(0,1,2),
            array(0,1,-1),
            array(10,20,999),
            array(-10,20,-11),
        );
    }
    
    public function providerNotNumeric() 
    {
        return array(
            array('a',1,1),
            array(0,' ',1),
            array(10,20,'zas a'),
            array(-10,20,' '),
            array(null,20,' ')
        );
    }

    /**
     * @dataProvider providerValid
     */
    public function testNumericBetweenBounds($min, $max, $input)
    {
        $o = new NumericBetween($min, $max);
        $this->assertTrue($o->assert($input));
    }

    /**
     * @dataProvider providerInvalid
     * @expectedException Respect\Validation\Exceptions\NumberOutOfBoundsException
     */
    public function testNumericNotBetweenBounds($min, $max, $input)
    {
        $o = new NumericBetween($min, $max);
        $this->assertTrue($o->assert($input));
    }
    
    /**
     * @dataProvider providerNotNumeric
     * @expectedException Respect\Validation\Exceptions\NotNumericException
     */
    public function testNotNumeric($min,$max,$input)
    {
        $o = new NumericBetween($min, $max);
        $this->assertTrue($o->assert($input));
    }

}