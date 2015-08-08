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

class InTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForIn
     */
    public function testSuccessInValidatorCases($input, $options = null)
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
    public function testInvalidInChecksShouldThrowInException($input, $options, $strict = false)
    {
        $v = new In($options, $strict);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InException
     * @expectedExceptionMessage "x" must be in ('foo', 'bar')
     */
    public function testInCheckExceptionMessageWithArray()
    {
        $v = new In(array('foo', 'bar'));
        $v->assert('x');
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
