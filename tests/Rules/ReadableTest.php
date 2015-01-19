<?php

namespace Respect\Validation\Rules;

$GLOBALS['is_readable'] = null;

function is_readable($readable)
{
    $return = \is_readable($readable); // Running the real function
    if (null !== $GLOBALS['is_readable']) {
        $return             = $GLOBALS['is_readable'];
        $GLOBALS['is_readable'] = null;
    }

    return $return;
}

class ReadableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Respect\Validation\Rules\Readable::validate
     */
    public function testValidReadableFileShouldReturnTrue()
    {
        $GLOBALS['is_readable'] = true;

        $rule = new Readable();
        $input = '/path/of/a/valid/readable/file.txt';
        $this->assertTrue($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\Readable::validate
     */
    public function testInvalidReadableFileShouldReturnFalse()
    {
        $GLOBALS['is_readable'] = false;

        $rule = new Readable();
        $input = '/path/of/an/invalid/readable/file.txt';
        $this->assertFalse($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\Readable::validate
     */
    public function testShouldValidateObjects()
    {
        $rule = new Readable();
        $object = $this->getMock('SplFileInfo', array('isReadable'), array('somefile.txt'));
        $object->expects($this->once())
                ->method('isReadable')
                ->will($this->returnValue(true));

        $this->assertTrue($rule->validate($object));
    }

}
