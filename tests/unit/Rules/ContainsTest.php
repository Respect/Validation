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
 * @covers Respect\Validation\Rules\Contains
 * @covers Respect\Validation\Exceptions\ContainsException
 */
class ContainsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForContainsIdentical
     */
    public function testStringsContainingExpectedIdenticalValueShouldPass($start, $input)
    {
        $v = new Contains($start, true);
        $this->assertTrue($v->validate($input));
    }

    /**
     * @dataProvider providerForContains
     */
    public function testStringsContainingExpectedValueShouldPass($start, $input)
    {
        $v = new Contains($start, false);
        $this->assertTrue($v->validate($input));
    }

    /**
     * @dataProvider providerForNotContainsIdentical
     */
    public function testStringsNotContainsExpectedIdenticalValueShouldNotPass($start, $input)
    {
        $v = new Contains($start, true);
        $this->assertFalse($v->validate($input));
    }

    /**
     * @dataProvider providerForNotContains
     */
    public function testStringsNotContainsExpectedValueShouldNotPass($start, $input)
    {
        $v = new Contains($start, false);
        $this->assertFalse($v->validate($input));
    }

    public function providerForContains()
    {
        return array(
            array('foo', array('bar', 'foo')),
            array('foo', 'barbazFOO'),
            array('foo', 'barbazfoo'),
            array('foo', 'foobazfoO'),
            array('1', array(2, 3, 1)),
            array('1', array(2, 3, '1')),
        );
    }

    public function providerForContainsIdentical()
    {
        return array(
            array('foo', array('fool', 'foo')),
            array('foo', 'barbazfoo'),
            array('foo', 'foobazfoo'),
            array('1', array(2, 3, (string) 1)),
            array('1', array(2, 3, '1')),
        );
    }

    public function providerForNotContains()
    {
        return array(
            array('foo', ''),
            array('bat', array('bar', 'foo')),
            array('foo', 'barfaabaz'),
            array('foo', 'faabarbaz'),
        );
    }

    public function providerForNotContainsIdentical()
    {
        return array(
            array('foo', ''),
            array('bat', array('BAT', 'foo')),
            array('bat', array('BaT', 'Batata')),
            array('foo', 'barfaabaz'),
            array('foo', 'barbazFOO'),
            array('foo', 'faabarbaz'),
        );
    }
}