<?php

namespace Respect\Validation\Rules;

class OddTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Odd;
    }

    /**
     * @dataProvider providerForOdd
     *
     */
    public function testOdd($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotOdd
     * @expectedException Respect\Validation\Exceptions\OddException
     */
    public function testNotOdd($input)
    {
        $this->assertTrue($this->object->assert($input));
    }
    
    /**
     * @dataProvider providerForNotInt
     * @expectedException Respect\Validation\Exceptions\IntException
     */
    public function testNotInt($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForOdd()
    {
        return array(
            array(-5),
            array(-1),
            array(1),
            array(13),
        );
    }

    public function providerForNotOdd()
    {
        return array(
            array(-2),
            array(-0),
            array(0),
            array(32),            
        );
    }
    
    public function providerForNotInt()
    {
        return array(
            array(null),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
            array('1.44'),
            array(1e-5),
        );
    }

}