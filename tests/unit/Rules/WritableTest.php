<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;

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
class WritableTest extends TestCase
{
    /**
     * @covers \Respect\Validation\Rules\Writable::validate
     */
    public function testValidWritableFileShouldReturnTrue(): void
    {
        $GLOBALS['is_writable'] = true;

        $rule = new Writable();
        $input = '/path/of/a/valid/writable/file.txt';
        self::assertTrue($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Writable::validate
     */
    public function testInvalidWritableFileShouldReturnFalse(): void
    {
        $GLOBALS['is_writable'] = false;

        $rule = new Writable();
        $input = '/path/of/an/invalid/writable/file.txt';
        self::assertFalse($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Writable::validate
     */
    public function testShouldValidateObjects(): void
    {
        $rule = new Writable();
        $object = $this->createMock('SplFileInfo', ['isWritable'], ['somefile.txt']);
        $object->expects($this->once())
                ->method('isWritable')
                ->will($this->returnValue(true));

        self::assertTrue($rule->validate($object));
    }
}
