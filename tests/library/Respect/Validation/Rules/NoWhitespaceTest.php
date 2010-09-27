<?php

namespace Respect\Validation\Rules;

class NoWhitespaceTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new NoWhitespace;
    }

    public function testNoWhitespace()
    {
        $this->assertTrue($this->object->assert('wpoiur'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\WhitespaceFoundException
     */
    public function testWhitespace()
    {
        $this->assertTrue($this->object->assert('w poiur'));
    }

}