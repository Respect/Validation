<?php
namespace Respect\Validation\Rules;

class InTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForIn
     *
     */
    public function testSuccessInValidatorCases($input, $options=null)
    {
        $v = new In($options);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotIn
     * @expectedException Respect\Validation\Exceptions\InException
     */
    public function testInvalidInChecksShouldThrowInException($input, $options, $strict=false)
    {
        $v = new In($options, $strict);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForIn()
    {
        return array(
            array('', 'barfoobaz'),
            array('foo', array('foo', 'bar')),
            array('foo', 'barfoobaz'),
            array('foo', 'foobarbaz'),
            array('foo', 'barbazfoo'),
            array('1', array(1, 2, 3)),
            array('1', array('1', 2, 3), true),
        );
    }

    public function providerForNotIn()
    {
        return array(
            array('bat', array('foo', 'bar')),
            array('foo', 'barfaabaz'),
            array('foo', 'faabarbaz'),
            array('foo', 'baabazfaa'),
            array('1', array(1, 2, 3), true),
        );
    }
}

