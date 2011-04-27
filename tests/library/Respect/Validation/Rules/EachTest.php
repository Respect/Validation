<?php

namespace Respect\Validation\Rules;

class EachTest extends \PHPUnit_Framework_TestCase
{

    public function testEach()
    {
        $v = new Each(new NotEmpty());
        $result = $v->validate(array(1, 2, 3, 4, 5));
        $this->assertTrue($result);
    }

    public function testEachCheck()
    {
        $v = new Each(new NotEmpty());
        $result = $v->check(array(1, 2, 3, 4, 5));
        $this->assertTrue($result);
    }

    public function testEachKey()
    {
        $v = new Each(new Alpha(), new Int());
        $result = $v->validate(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }
    public function testEachKeyCheck()
    {
        $v = new Each(new Alpha(), new Int());
        $result = $v->check(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }

    public function testEachKeyOnly()
    {
        $v = new Each(null, new Int());
        $result = $v->validate(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }
    public function testEachKeyOnlyCheck()
    {
        $v = new Each(null, new Int());
        $result = $v->check(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }

    public function testEachNotTraversable()
    {
        $v = new Each(new NotEmpty());
        $result = $v->validate(null);
        $this->assertTrue($result);
    }

    public function testEachOneInvalid()
    {
        $v = new Each(new NotEmpty());
        $result = $v->validate(array('', 2, 3, 4, 5));
        $this->assertFalse($result);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EachException
     */
    public function testEachOneInvalidAssertion()
    {
        $v = new Each(new Int());
        $result = $v->assert(array('a', 2, 3, 4, 5));
        $this->assertFalse($result);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EachException
     */
    public function testEachOneInvalidInput()
    {
        $v = new Each(new NotEmpty());
        $result = $v->assert(123);
        $this->assertFalse($result);
    }

}