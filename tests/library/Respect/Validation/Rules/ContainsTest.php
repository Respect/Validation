<?php

namespace Respect\Validation\Rules;

class ContainsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForContains
     */
    public function test_strings_containing_expected_value_should_pass($start, $input)
    {
        $v = new Contains($start);
        $this->assertTrue($v->validate($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotContains
     * @expectedException Respect\Validation\Exceptions\ContainsException
     */
    public function test_strings_NOT_contains_expected_value_shoud_NOT_pass($start, $input, $identical=false)
    {
        $v = new Contains($start, $identical);
        $this->assertFalse($v->validate($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForContains()
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