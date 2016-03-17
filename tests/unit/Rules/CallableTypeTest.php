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
 * @covers Respect\Validation\Rules\CallableType
 * @covers Respect\Validation\Exceptions\CallableTypeException
 */
class CallableTypeTest extends \PHPUnit_Framework_TestCase
{
    protected $rule;

    protected function setUp()
    {
        $this->rule = new CallableType();
    }

    /**
     * @dataProvider providerForCallable
     */
    public function testShouldValidateCallableTypeNumbers($input)
    {
        $this->assertTrue($this->rule->validate($input));
    }

    /**
     * @dataProvider providerForNonCallable
     */
    public function testShouldNotValidateNonCallableTypeNumbers($input)
    {
        $this->assertFalse($this->rule->validate($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\CallableTypeException
     * @expectedExceptionMessage "testShouldThrowCallableTypeExceptionWhenChecking" must be a callable
     */
    public function testShouldThrowCallableTypeExceptionWhenChecking()
    {
        $this->rule->check(__FUNCTION__);
    }

    public function providerForCallable()
    {
        return [
            [function () {}],
            ['trim'],
            [__METHOD__],
            [[$this, __FUNCTION__]],
        ];
    }

    public function providerForNonCallable()
    {
        return [
            [' '],
            [INF],
            [[]],
            [new \stdClass()],
            [null],
        ];
    }
}
