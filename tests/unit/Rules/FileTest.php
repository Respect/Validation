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

$GLOBALS['is_file'] = null;

function is_file($file)
{
    $return = \is_file($file); // Running the real function
    if (null !== $GLOBALS['is_file']) {
        $return = $GLOBALS['is_file'];
        $GLOBALS['is_file'] = null;
    }

    return $return;
}

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\File
 * @covers \Respect\Validation\Exceptions\FileException
 */
class FileTest extends TestCase
{
    /**
     * @covers \Respect\Validation\Rules\File::validate
     */
    public function testValidFileShouldReturnTrue(): void
    {
        $GLOBALS['is_file'] = true;

        $rule = new File();
        $input = '/path/of/a/valid/file.txt';
        self::assertTrue($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\File::validate
     */
    public function testInvalidFileShouldReturnFalse(): void
    {
        $GLOBALS['is_file'] = false;

        $rule = new File();
        $input = '/path/of/an/invalid/file.txt';
        self::assertFalse($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\File::validate
     */
    public function testShouldValidateObjects(): void
    {
        $rule = new File();
        $object = $this->createMock('SplFileInfo', ['isFile'], ['somefile.txt']);
        $object->expects($this->once())
                ->method('isFile')
                ->will($this->returnValue(true));

        self::assertTrue($rule->validate($object));
    }
}
