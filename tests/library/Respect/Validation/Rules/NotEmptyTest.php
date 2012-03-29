<?php

namespace Respect\Validation\Rules;

class NotEmptyTest extends \PHPUnit_Framework_TestCase
{

    protected $object;

    protected function setUp()
    {
        $this->object = new NotEmpty;
    }

    /**
     * @dataProvider providerForNotEmpty
     */
    public function testStringNotEmpty($input)
    {
        $this->assertTrue($this->object->assert($input));
    }

    /**
     * @dataProvider providerForEmpty
     * @expectedException Respect\Validation\Exceptions\NotEmptyException
     */
    public function testStringEmpty($input)
    {
        $this->assertFalse($this->object->assert($input));
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
            array(''),
            array('    '),
            array("\n"),
            array(false),
            array(null),
            array(array())
        );
    }

}