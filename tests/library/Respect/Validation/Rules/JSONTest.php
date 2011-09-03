<?php

namespace Respect\Validation\Rules;

class JSONTest extends \PHPUnit_Framework_TestCase
{

    public function testValidJSON()
    {
        $object = new JSON('{"foo": "bar", "number":1}');
        $this->assertTrue($object->assert($object->json));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\JSONException
     */
    public function testInvalidJSON()
    {
        $object = new JSON("{foo:bar}");
        $this->assertFalse($object->assert($object->json));
    }
}
