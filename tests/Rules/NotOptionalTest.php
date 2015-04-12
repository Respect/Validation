<?php

namespace Respect\Validation\Rules;

class NotOptionalTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new NotOptional;
    }

    /**
     * @dataProvider providerForEmpty
     */
    public function testEmptyValue($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForNotEmpty
     */
    public function testStringNotEmpty($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\NotOptionalException
     */
    public function testStringEmpty()
    {
        $this->assertFalse($this->object->assert(''));
    }

    public function providerForNotEmpty()
    {
        return array(
            array(1),
            array(' oi'),
            array(array(5)),
            array(array(0)),
            array(new \stdClass)
        );
    }

    public function providerForEmpty()
    {
        return array(
            array('    '),
            array("\n"),
            array(false),
            array(null),
            array(array())
        );
    }
}
