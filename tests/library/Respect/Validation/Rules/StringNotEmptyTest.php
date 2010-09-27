<?php

namespace Respect\Validation\Rules;

class StringNotEmptyTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new StringNotEmpty;
    }

    public function testStringNotEmpty()
    {
        $this->assertTrue($this->object->assert('xsdfgf'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\EmptyStringException
     */
    public function testStringEmpty()
    {
        $this->assertTrue($this->object->assert(' '));
    }

}