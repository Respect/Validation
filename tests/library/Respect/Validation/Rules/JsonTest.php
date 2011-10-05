<?php

namespace Respect\Validation\Rules;

class JsonTest extends \PHPUnit_Framework_TestCase
{

    protected $json;
    
    protected function setUp()
    {
        $this->json = new Json;
    }
    
    public function testValidJSON()
    {
        $this->assertTrue($this->json->assert('{"foo": "bar", "number":1}'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\JSONException
     */
    public function testInvalidJSON()
    {
        $this->assertFalse($this->json->assert("{foo:bar}"));
    }
}
