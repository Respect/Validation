<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

$GLOBALS['is_writable'] = null;

function is_writable($writable)
{
    $return = \is_writable($writable); // Running the real function
    if (null !== $GLOBALS['is_writable']) {
        $return = $GLOBALS['is_writable'];
        $GLOBALS['is_writable'] = null;
    }

    return $return;
}

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Writable
 * @covers \Respect\Validation\Exceptions\WritableException
 */
class WritableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \Respect\Validation\Rules\Writable::validate
     */
    public function testValidWritableFileShouldReturnTrue()
    {
        $GLOBALS['is_writable'] = true;

        $rule = new Writable();
        $input = '/path/of/a/valid/writable/file.txt';
        $this->assertTrue($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Writable::validate
     */
    public function testInvalidWritableFileShouldReturnFalse()
    {
        $GLOBALS['is_writable'] = false;

        $rule = new Writable();
        $input = '/path/of/an/invalid/writable/file.txt';
        $this->assertFalse($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Writable::validate
     */
    public function testShouldValidateObjects()
    {
        $rule = new Writable();
        $object = $this->createMock('SplFileInfo', ['isWritable'], ['somefile.txt']);
        $object->expects($this->once())
                ->method('isWritable')
                ->will($this->returnValue(true));

        $this->assertTrue($rule->validate($object));
    }
}
