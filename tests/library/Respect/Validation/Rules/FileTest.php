<?php

namespace Respect\Validation\Rules;

$GLOBALS['is_file'] = null;

function is_file($file)
{
    $return = \is_file($file); // Running the real function
    if (null !== $GLOBALS['is_file']) {
        $return             = $GLOBALS['is_file'];
        $GLOBALS['is_file'] = null;
    }

    return $return;
}

class FileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Respect\Validation\Rules\File::validate
     */
    public function testValidFileShouldReturnTrue()
    {
        $GLOBALS['is_file'] = true;

        $rule = new File();
        $input = '/path/of/a/valid/file.txt';
        $this->assertTrue($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\File::validate
     */
    public function testInvalidFileShouldReturnFalse()
    {
        $GLOBALS['is_file'] = false;

        $rule = new File();
        $input = '/path/of/an/invalid/file.txt';
        $this->assertFalse($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\File::validate
     */
    public function testShouldValidateObjects()
    {
        $rule = new File();
        $object = $this->getMock('SplFileInfo', array('isFile'), array('somefile.txt'));
        $object->expects($this->once())
                ->method('isFile')
                ->will($this->returnValue(true));

        $this->assertTrue($rule->validate($object));
    }

}
