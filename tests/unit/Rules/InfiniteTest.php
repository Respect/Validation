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
 * @covers Respect\Validation\Rules\Infinite
 * @covers Respect\Validation\Exceptions\InfiniteException
 */
class InfiniteTest extends \PHPUnit_Framework_TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new Infinite();
    }

    /**
     * @dataProvider providerForInfinite
     */
    public function testShouldValidateInfiniteNumbers($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonInfinite
     */
    public function testShouldNotValidateNonInfiniteNumbers($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InfiniteException
     * @expectedExceptionMessage 123456 must be an infinite number
     */
    public function testShouldThrowInfiniteExceptionWhenChecking()
    {
        $this->rule->check(123456);
    }

    public function providerForInfinite()
    {
        return array(
            array(INF),
            array(INF * -1),
        );
    }

    public function providerForNonInfinite()
    {
        return array(
            array(' '),
            array(array()),
            array(new \stdClass()),
            array(null),
            array('123456'),
            array(-9),
            array(0),
            array(16),
            array(2),
            array(PHP_INT_MAX),
        );
    }
}
