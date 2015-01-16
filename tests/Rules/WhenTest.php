<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\When
 */
class WhenTest extends \PHPUnit_Framework_TestCase
{
    public function testWhenHappypath()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertTrue($v->validate(3));
        $this->assertTrue($v->validate('aaa'));
    }

    public function testWhenError()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->validate(15));
    }

    public function testWhenWithoutElseHappypath()
    {
        $v = new When(new Int(), new Between(1,5));

        $this->assertTrue($v->validate(3));
    }

    public function testWhenWithoutElseError()
    {
        $v = new When(new String(), new Between(1,5));

        $this->assertFalse($v->validate(15));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\AlwaysInvalidException
     * @expectedExceptionMessage "15" is not valid
     */
    public function testWhenWithoutElseAssert()
    {
        $v = new When(new String(), new Between(1,5));
        $v->assert(15);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\BetweenException
     */
    public function testWhenException()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->assert(15));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testWhenException_on_else()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->assert(''));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\MaxException
     */
    public function testWhenException_failfast()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->check(15));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testWhenException_on_else_failfast()
    {
        $v = new When(new Int(), new Between(1,5), new NotEmpty());
        $this->assertFalse($v->check(''));
    }
}

