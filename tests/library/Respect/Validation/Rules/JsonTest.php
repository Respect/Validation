<?php

namespace Respect\Validation\Rules;

class JsonTest extends \PHPUnit_Framework_TestCase
{

    protected $json;

    protected function setUp()
    {
        $this->json = new Json;
    }

    public function testValidJsonsShouldReturnTrue()
    {
        $this->assertTrue($this->json->validate('{"foo": "bar", "number":1}'));
        $this->assertTrue($this->json->check('{"foo": "bar", "number":1}'));
        $this->assertTrue($this->json->assert('{"foo": "bar", "number":1}'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\JSonException
     */
    public function testInvalidJsonsShouldThrowJsonException()
    {
        $this->assertFalse($this->json->validate("{foo:bar}"));
        $this->assertFalse($this->json->assert("{foo:bar}"));
    }
}
