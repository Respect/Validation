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
        $v = new Each(new NotEmpty());
        $result = $v->assert(array('', 2, 3, 4, 5));
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