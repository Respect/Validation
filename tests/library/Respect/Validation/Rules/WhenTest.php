<?php

namespace Respect\Validation\Rules;

class WhenTest extends \PHPUnit_Framework_TestCase
{

    public function test_when_happypath()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertTrue($v->validate(3));
        $this->assertTrue($v->validate('aaa'));
    }
    public function test_when_error()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->validate(15));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\BetweenException
     */
    public function test_when_exception()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->assert(15));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function test_when_exception_on_else()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->assert(''));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\MaxException
     */
    public function test_when_exception_failfast()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->check(15));
    }
    /**
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function test_when_exception_on_else_failfast()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->check(''));
    }
}
