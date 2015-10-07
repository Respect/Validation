<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

/**
 * @group  rule
 * @covers Respect\Validation\Rules\EndsWith
 * @covers Respect\Validation\Exceptions\EndsWithException
 */
class EndsWithTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForEndsWith
     */
    public function testStringsEndingWithExpectedValueShouldPass($start, $input)
    {
        $v = new EndsWith($start);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotEndsWith
     * @expectedException Respect\Validation\Exceptions\EndsWithException
     */
    public function testStringsNotEndingWithExpectedValueShouldNotPass($start, $input, $caseSensitive = false)
    {
        $v = new EndsWith($start, $caseSensitive);
        $this->assertFalse($v->__invoke($input));
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
            array('foo', ''),
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
