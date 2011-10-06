<?php

namespace Respect\Validation\Rules;

class EndsWithTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForEndsWith
     */
    public function test_strings_ending_with_expected_value_should_pass($start, $input)
    {
        $v = new EndsWith($start);
        $this->assertTrue($v->validate($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotEndsWith
     * @expectedException Respect\Validation\Exceptions\EndsWithException
     */
    public function test_strings_NOT_ending_with_expected_value_shoud_NOT_pass($start, $input, $caseSensitive=false)
    {
        $v = new EndsWith($start, $caseSensitive);
        $this->assertFalse($v->validate($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForEndsWith()
    {
        return array(
            array('foo', array('bar', 'foo')),
            array('foo', 'barbazFOO'),
            array('foo', 'barbazfoo'),
            array('foo', 'foobazfoo'),
            array('1', array(2, 3, 1)),
            array('1', array(2, 3, '1'), true),
        );
    }

    public function providerForNotEndsWith()
    {
        return array(
            array('bat', array('bar', 'foo')),
            array('foo', 'barfaabaz'),
            array('foo', 'barbazFOO', true),
            array('foo', 'faabarbaz'),
            array('foo', 'baabazfaa'),
            array('foo', 'baafoofaa'),
            array('1', array(1, '1', 3), true),
        );
    }

}