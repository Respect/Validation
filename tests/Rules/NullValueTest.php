<?php
namespace Respect\Validation\Rules;

class NullValueTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NullValue;
    }

    public function testNullValue()
    {
        $this->assertTrue($this->object->assert(null));
        $this->assertTrue($this->object->__invoke(null));
        $this->assertTrue($this->object->check(null));
    }

    /**
     * @dataProvider providerForNotNull
     * @expectedException Respect\Validation\Exceptions\NullValueException
     */
    public function testNotNull($input)
    {
        $this->assertFalse($this->object->__invoke($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForNotNull()
    {
        return array(
            array(''),
            array(0),
            array('w poiur'),
            array(' '),
            array('Foo'),
        );
    }

}

