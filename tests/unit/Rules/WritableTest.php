<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\StreamStub;
use SplFileInfo;
use SplFileObject;
use stdClass;

use function chmod;

#[Group('validator')]
#[CoversClass(Writable::class)]
final class WritableTest extends RuleTestCase
{
    /** @return iterable<array{Writable, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new Writable();
        $filename = self::fixture('valid-image.png');
        $directory = self::fixture();

        chmod($filename, 0644);
        chmod($directory, 0755);

        return [
            'writable file' => [$sut, $filename],
            'writable directory' => [$sut, $directory],
            'writable SplFileInfo file' => [$sut, new SplFileInfo($filename)],
            'writable SplFileObject file' => [$sut, new SplFileObject($filename)],
            'writable PSR-7 stream' => [$sut, StreamStub::create()],
        ];
    }

    /** @return iterable<array{Writable, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $validator = new Writable();
        $filename = self::fixture('non-writable');

        chmod($filename, 0555);

        return [
            'unwritable PSR-7 stream' => [$validator, StreamStub::createUnwritable()],
            'unwritable filename' => [$validator, $filename],
            'unwritable SplFileInfo file' => [$validator, new SplFileInfo($filename)],
            'unwritable SplFileObject file' => [$validator, new SplFileObject($filename)],
            'invalid filename' => [$validator, '/path/of/a/valid/writable/file.txt'],
            'empty string' => [$validator, ''],
            'boolean true' => [$validator, true],
            'boolean false' => [$validator, false],
            'integer' => [$validator, 123456],
            'float' => [$validator, 1.1111],
            'instance of stdClass' => [$validator, new stdClass()],
            'array' => [$validator, []],
        ];
    }
}
