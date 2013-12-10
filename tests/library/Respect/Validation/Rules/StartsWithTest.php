<?php
namespace Respect\Validation\Rules;

class StartsWithTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForStartsWith
     *
     */
    public function testStartsWith($start, $input)
    {
        $v = new StartsWith($start);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotStartsWith
     * @expectedException Respect\Validation\Exceptions\StartsWithException
     */
    public function testNotStartsWith($start, $input, $caseSensitive=false)
    {
        $v = new StartsWith($start, $caseSensitive);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForStartsWith()
    {
        return array(
            array('foo', ''),
            array('foo', array('foo', 'bar')),
            array('foo', 'FOObarbaz'),
            array('foo', 'foobarbaz'),
            array('foo', 'foobazfoo'),
            array('1', array(1, 2, 3)),
            array('1', array('1', 2, 3), true),
        );
    }

    public function providerForNotStartsWith()
    {
        return array(
            array('bat', array('foo', 'bar')),
            array('foo', 'barfaabaz'),
            array('foo', 'FOObarbaz', true),
            array('foo', 'faabarbaz'),
            array('foo', 'baabazfaa'),
            array('foo', 'baafoofaa'),
            array('1', array(1, '1', 3), true),
        );
    }
}

