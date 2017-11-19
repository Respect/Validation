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

$GLOBALS['is_uploaded_file'] = null;

function is_uploaded_file($uploaded)
{
    $return = \is_uploaded_file($uploaded); // Running the real function
    if (null !== $GLOBALS['is_uploaded_file']) {
        $return = $GLOBALS['is_uploaded_file'];
        $GLOBALS['is_uploaded_file'] = null;
    }

    return $return;
}

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Uploaded
 * @covers \Respect\Validation\Exceptions\UploadedException
 */
class UploadedTest extends TestCase
{
    /**
     * @covers \Respect\Validation\Rules\Uploaded::validate
     */
    public function testValidUploadedFileShouldReturnTrue(): void
    {
        $GLOBALS['is_uploaded_file'] = true;

        $rule = new Uploaded();
        $input = '/path/of/a/valid/uploaded/file.txt';
        self::assertTrue($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Uploaded::validate
     */
    public function testInvalidUploadedFileShouldReturnFalse(): void
    {
        $GLOBALS['is_uploaded_file'] = false;

        $rule = new Uploaded();
        $input = '/path/of/an/invalid/uploaded/file.txt';
        self::assertFalse($rule->validate($input));
    }

    /**
     * @covers \Respect\Validation\Rules\Uploaded::validate
     */
    public function testShouldValidateObjects(): void
    {
        $GLOBALS['is_uploaded_file'] = true;

        $rule = new Uploaded();
        $object = new \SplFileInfo('/path/of/an/uploaded/file');

        self::assertTrue($rule->validate($object));
    }
}
