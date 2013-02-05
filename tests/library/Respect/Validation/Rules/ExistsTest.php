<?php

namespace Respect\Validation\Rules;

$GLOBALS['file_exists'] = null;

function file_exists($file)
{
    $return = \file_exists($file); // Running the real function
    if (null !== $GLOBALS['file_exists']) {
        $return                 = $GLOBALS['file_exists'];
        $GLOBALS['file_exists'] = null;
    }

    return $return;
}

class ExistsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Respect\Validation\Rules\Exists::validate
     */
    public function testExistentFileShouldReturnTrue()
    {
        $GLOBALS['file_exists'] = true;

        $rule = new Exists();
        $input = '/path/of/an/existent/file';
        $this->assertTrue($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\Exists::validate
     */
    public function testNonExistentFileShouldReturnFalse()
    {
        $GLOBALS['file_exists'] = false;

        $rule = new Exists();
        $input = '/path/of/a/non-existent/file';
        $this->assertFalse($rule->validate($input));
    }

    /**
     * @covers Respect\Validation\Rules\Exists::validate
     */
    public function testShouldValidateObjects()
    {
        $GLOBALS['file_exists'] = true;

        $rule = new Exists();
        $object = new \SplFileInfo('/path/of/an/existent/file');

        $this->assertTrue($rule->validate($object));
    }

}
