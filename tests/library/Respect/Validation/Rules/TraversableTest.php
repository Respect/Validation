<?php

namespace Respect\Validation\Rules;

class TraversableTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new Traversable;
    }

    /**
     * @dataProvider providerForTraversable
     *
     */
    public function testTraversable($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotTraversable
     * @expectedException Respect\Validation\Exceptions\TraversableException
     */
    public function testNotTraversable($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    public function providerForTraversable()
    {
        return array(
            array(array()),
            array(array(1, 2, 3)),
            array(array(1 => 2)),
            array(new \ArrayObject(array(1 => 2))),
        );
    }

    public function providerForNotTraversable()
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