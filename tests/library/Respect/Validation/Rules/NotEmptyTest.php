<?php

namespace Respect\Validation\Rules;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new NotEmpty;
    }

    public function testStringNotEmpty()
    {
        $this->assertTrue($this->object->assert('xsdfgf'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ValidationException
     */
    public function testStringEmpty()
    {
        $this->assertTrue($this->object->assert(' '));
    }

}