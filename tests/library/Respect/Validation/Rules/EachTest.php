<?php

namespace Respect\Validation\Rules;

class EachTest extends \PHPUnit_Framework_TestCase
{

    public function test_validator_should_pass_if_every_array_item_pass()
    {
        $v = new Each(new NotEmpty());
        $result = $v->validate(array(1, 2, 3, 4, 5));
        $this->assertTrue($result);
        $result = $v->check(array(1, 2, 3, 4, 5));
        $this->assertTrue($result);
        $result = $v->assert(array(1, 2, 3, 4, 5));
        $this->assertTrue($result);
    }

    public function test_validator_should_pass_if_every_array_item_and_key_pass()
    {
        $v = new Each(new Alpha(), new Int());
        $result = $v->validate(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
        $result = $v->check(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
        $result = $v->assert(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }

    public function test_validator_should_pass_with_only_key_validation()
    {
        $v = new Each(null, new Int());
        $result = $v->validate(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
        $result = $v->check(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
        $result = $v->assert(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EachException
     */
    public function test_validator_should_NOT_pass_with_only_key_validation()
    {
        $v = new Each(null, new String());
        $result = $v->assert(array('a', 'b', 'c', 'd', 'e'));
        $this->assertTrue($result);
    }

    public function test_not_traversable_validator_should_fail()
    {
        $v = new Each(new NotEmpty());
        $result = $v->validate(null);
        $this->assertFalse($result);
    }

    public function test_validator_should_fail_on_invalid_item()
    {
        $v = new Each(new NotEmpty());
        $result = $v->validate(array('', 2, 3, 4, 5));
        $this->assertFalse($result);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EachException
     */
    public function test_assert_should_fail_on_invalid_item()
    {
        $v = new Each(new Int());
        $result = $v->assert(array('a', 2, 3, 4, 5));
        $this->assertFalse($result);
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EachException
     */
    public function test_assert_should_fail_on_non_traversable()
    {
        $v = new Each(new NotEmpty());
        $result = $v->assert(123);
        $this->assertFalse($result);
    }

}