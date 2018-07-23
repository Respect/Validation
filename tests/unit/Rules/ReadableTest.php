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

$GLOBALS['is_readable'] = null;

function is_readable($readable)
{
    $return = \is_readable($readable); // Running the real function
    if (null !== $GLOBALS['is_readable']) {
        $return = $GLOBALS['is_readable'];
        $GLOBALS['is_readable'] = null;
    }

    return $return;
}

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\ReadableException
 * @covers \Respect\Validation\Rules\Readable
 */
class ReadableTest extends TestCase
{
    /**
     * @covers \Respect\Validation\Rules\Readable::validate
     *
     * @test
     */
    public function validReadableFileShouldReturnTrue(): void
    {
        $GLOBALS['is_readable'] = true;

        $rule = new Readable();
        $input = '/path/of/a/valid/readable/file.txt';
        self::assertTrue($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Readable::validate
     *
     * @test
     */
    public function invalidReadableFileShouldReturnFalse(): void
    {
        $GLOBALS['is_readable'] = false;

        $rule = new Readable();
        $input = '/path/of/an/invalid/readable/file.txt';
        self::assertFalse($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Readable::validate
     *
     * @test
     */
    public function shouldValidateObjects(): void
    {
        $rule = new Readable();
        $object = $this->createMock('SplFileInfo', ['isReadable'], ['somefile.txt']);
        $object->expects(self::once())
                ->method('isReadable')
                ->will(self::returnValue(true));

        self::assertTrue($rule->validate($object));
    }
}
