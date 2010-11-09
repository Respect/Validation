<?php

namespace Respect\Validation\Rules;

class ArrTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Arr;
    }

    /**
     * @dataProvider providerForArr
     *
     */
    public function testArr($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotArr
     * @expectedException Respect\Validation\Exceptions\NotArrayException
     */
    public function testNotArr($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForArr()
    {
        return array(
            array(array()),
            array(array(1, 2, 3)),
            array(array(1 => 2)),
        );
    }

    public function providerForNotArr()
    {
        return array(
            array(null),
            array(new \stdClass),
            array(' '),
            array(12321),
            array(''),
        );
    }

}