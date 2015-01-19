<?php
namespace Respect\Validation\Rules;

class ContainsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForContains
     */
    public function testStringsContainingExpectedValueShouldPass($start, $input)
    {
        $v = new Contains($start);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotContains
     * @expectedException Respect\Validation\Exceptions\ContainsException
     */
    public function testStringsNotContainsExpectedValueShouldNotPass($start, $input, $identical=false)
    {
        $v = new Contains($start, $identical);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForContains()
    {
        return array(
            array('foo', ''),
            array('foo', array('bar', 'foo')),
            array('foo', 'barbazFOO'),
            array('foo', 'barbazfoo'),
            array('foo', 'foobazfoo'),
            array('1', array(2, 3, 1)),
            array('1', array(2, 3, '1'), true),
        );
    }

    public function providerForNotContains()
    {
        return array(
            array('bat', array('bar', 'foo')),
            array('foo', 'barfaabaz'),
            array('foo', 'barbazFOO', true),
            array('foo', 'faabarbaz'),
        );
    }
}

