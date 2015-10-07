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
 * @covers Respect\Validation\Rules\Equals
 * @covers Respect\Validation\Exceptions\EqualsException
 */
class EqualsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerForEquals
     */
    public function testStringsContainingExpectedValueShouldPass($start, $input)
    {
        $v = new Equals($start);
        $this->assertTrue($v->__invoke($input));
        $this->assertTrue($v->check($input));
        $this->assertTrue($v->assert($input));
    }

    /**
     * @dataProvider providerForNotEquals
     * @expectedException Respect\Validation\Exceptions\EqualsException
     */
    public function testStringsNotEqualsExpectedValueShouldNotPass($start, $input, $identical = false)
    {
        $v = new Equals($start, $identical);
        $this->assertFalse($v->__invoke($input));
        $this->assertFalse($v->assert($input));
    }

    public function providerForEquals()
    {
        return array(
            array('foo', 'foo'),
            array(10, '10'),
        );
    }

    public function providerForNotEquals()
    {
        return array(
            array('foo', ''),
            array('foo', 'bar'),
            array(10, '10', true),
        );
    }
}
