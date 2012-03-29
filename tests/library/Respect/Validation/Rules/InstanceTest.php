<?php

namespace Respect\Validation\Rules;

class InstanceTest extends \PHPUnit_Framework_TestCase
{

    protected $instanceValidator;

    protected function setUp()
    {
        $this->instanceValidator = new Instance('ArrayObject');
    }

    public function test_instance_validation_should_return_true_for_valid_instances()
    {
        $this->assertTrue($this->instanceValidator->validate(new \ArrayObject));
        $this->assertTrue($this->instanceValidator->assert(new \ArrayObject));
        $this->assertTrue($this->instanceValidator->check(new \ArrayObject));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\InstanceException
     */
    public function test_invalid_instances_should_throw_InstanceException()
    {
        $this->assertFalse($this->instanceValidator->validate(new \stdClass));
        $this->assertFalse($this->instanceValidator->assert(new \stdClass));
    }

}