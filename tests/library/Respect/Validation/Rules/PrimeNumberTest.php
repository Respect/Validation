<?php

namespace Respect\Validation\Rules;

class PrimeNumberTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new PrimeNumber;
    }

    /**
     * @dataProvider providerForPrimeNumber
     *
     */
    public function testPrimeNumber($input)
    {
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPrimeNumber
     * @expectedException Respect\Validation\Exceptions\PrimeNumberException
     * 
     */
    public function testNotPrimeNumber($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForPrimeNumber()
    {
        return array(
            array(3),
            array(5),
            array(7),
            array('3'),
            array('5'),
            array('+7'),
        );
    }

    public function providerForNotPrimeNumber()
    {
        return array(
            array(null),
            array(0),
            array(10),
            array(25),
            array(36),
            array(-1),
            array('-1'),
            array('25'),
            array('0'),
            array('a'),
            array(' '),
            array('Foo'),
            array(''),
        );
    }

}

