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

$GLOBALS['is_executable'] = null;

function is_executable($executable)
{
    $return = \is_executable($executable); // Running the real function
    if (null !== $GLOBALS['is_executable']) {
        $return = $GLOBALS['is_executable'];
        $GLOBALS['is_executable'] = null;
    }

    return $return;
}

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Executable
 * @covers \Respect\Validation\Exceptions\ExecutableException
 */
class ExecutableTest extends TestCase
{
    public function testValidExecutableFileShouldReturnTrue(): void
    {
        $GLOBALS['is_executable'] = true;

        $rule = new Executable();
        $input = '/path/of/a/valid/executable/file.txt';
        self::assertTrue($rule->validate($input));
    }

    public function testInvalidExecutableFileShouldReturnFalse(): void
    {
        $GLOBALS['is_executable'] = false;

        $rule = new Executable();
        $input = '/path/of/an/invalid/executable/file.txt';
        self::assertFalse($rule->validate($input));
    }

    public function testShouldValidateObjects(): void
    {
        $rule = new Executable();
        $object = $this->createMock('SplFileInfo', ['isExecutable'], ['somefile.txt']);
        $object->expects($this->once())
                ->method('isExecutable')
                ->will($this->returnValue(true));

        self::assertTrue($rule->validate($object));
    }
}
