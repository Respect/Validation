<?php
namespace Respect\Validation\Rules;

class StringTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new String;
    }

    /**
     * @dataProvider providerForString
     *
     */
    public function testString($input)
    {
        $this->assertTrue($this->object->validate($input));
        $this->assertTrue($this->object->check($input));
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotString
     * @expectedException Respect\Validation\Exceptions\StringException
     */
    public function testNotString($input)
    {
        $this->assertFalse($this->object->validate($input));
        $this->assertFalse($this->object->assert($input));
    }

    public function providerForString()
    {
        return array(
            array(''),
            array('165.7'),
        );
    }

    public function providerForNotString()
    {
        return array(
            array(null),
            array(array()),
            array(new \stdClass),
            array(150)
        );
    }
}

