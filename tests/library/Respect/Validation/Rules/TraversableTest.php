<?php

namespace Respect\Validation\Rules;

class TraversableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForTraversable
     *
     */
    public function testTraversable($input)
    {
        $v = new Traversable;
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotTraversable
     * @expectedException Respect\Validation\Exceptions\TraversableException
     */
    public function testNotTraversable($input)
    {
        $v = new Traversable;
        $this->assertTrue($v->assert($input));
    }

    public function testTraversableItemValidator()
    {
        $v = new Traversable(new StringLength(5, 10));
        $this->assertTrue(
            $v->assert(
                array('alganet'), array('kingolabs'), array('respect')
            )
        );
    }

    /**
     * @dataProvider providerForNotTraversable
     * @expectedException Respect\Validation\Exceptions\TraversableException
     */
    public function testTraversableItemValidatorFalse()
    {
        $v = new Traversable(new StringLength(15, 30));
        $this->assertFalse(
            $v->assert(
                array('alganet'), array('kingolabs'), array('respect')
            )
        );
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