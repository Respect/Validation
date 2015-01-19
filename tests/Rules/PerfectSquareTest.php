<?php
namespace Respect\Validation\Rules;

class PerfectSquareTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new PerfectSquare;
    }

    /**
     * @dataProvider providerForPerfectSquare
     *
     */
    public function testPerfectSquare($input)
    {
        $this->assertTrue($this->object->__invoke($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotPerfectSquare
     * @expectedException Respect\Validation\Exceptions\PerfectSquareException
     *
     */
    public function testNotPerfectSquare($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForPerfectSquare()
    {
        return array(
            array(''),
            array(1),
            array(9),
            array(25),
            array('25'),
            array(400),
            array('400'),
            array('0'),
            array(81),
            array(0),
            array(250),
        );
    }

    public function providerForNotPerfectSquare()
    {
        return array(
            array(null),
            array(7),
            array(-1),
            array(6),
            array(2),
            array('-1'),
            array('a'),
            array(' '),
            array('Foo'),
        );
    }
}

