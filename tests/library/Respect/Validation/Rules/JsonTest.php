<?php
namespace Respect\Validation\Rules;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    protected $json;

    protected function setUp()
    {
        $this->json = new Json;
    }

    /**
     * @dataProvider providerForPass
     */
    public function testValidJsonsShouldReturnTrue($input)
    {
        $this->assertTrue($this->json->__invoke($input));
        $this->assertTrue($this->json->check($input));
        $this->assertTrue($this->json->assert($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\JSonException
     */
    public function testInvalidJsonsShouldThrowJsonException()
    {
        $this->assertFalse($this->json->__invoke("{foo:bar}"));
        $this->assertFalse($this->json->assert("{foo:bar}"));
    }

    public function providerForPass()
    {
        return array(
            array(''),
            array('2'),
            array('"abc"'),
            array('[1,2,3]'),
            array('["foo", "bar", "number", 1]'),
            array('{"foo": "bar", "number":1}'),
        );
    }

}

