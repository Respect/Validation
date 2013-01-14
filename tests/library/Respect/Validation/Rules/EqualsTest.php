<?php

namespace Respect\Validation\Rules;

class EqualsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForEquals
     */
    public function testStringsContainingExpectedValueShouldPass($start, $input)
    {
        $v = new Equals($start);
        $this->assertTrue($v->validate($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotEquals
     * @expectedException Respect\Validation\Exceptions\EqualsException
     */
    public function testStringsNotEqualsExpectedValueShoudNotPass($start, $input, $identical=false)
    {
        $v = new Equals($start, $identical);
        $this->assertFalse($v->validate($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForEquals()
    {
        return array(
            array('foo', 'foo'),
            array(10, "10"),
        );
    }

    public function providerForNotEquals()
    {
        return array(
            array('foo', 'bar'),
            array(10, "10", true),
        );
    }

}
