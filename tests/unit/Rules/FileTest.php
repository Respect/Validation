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
use SplFileInfo;
use SplFileObject;
use stdClass;

use const PHP_INT_MAX;

#[Group('rule')]
#[CoversClass(File::class)]
final class FileTest extends RuleTestCase
{
    /** @return iterable<array{File, mixed}> */
    public static function providerForValidInput(): iterable
    {
        $sut = new File();

        return [
            'filename' => [$sut, __FILE__],
            'SplFileInfo' => [$sut, new SplFileInfo(self::fixture('valid-image.png'))],
            'SplFileObject' => [$sut, new SplFileObject(self::fixture('invalid-image.png'))],
        ];
    }

    /** @return iterable<array{File, mixed}> */
    public static function providerForInvalidInput(): iterable
    {
        $sut = new File();

        return [
            'directory' => [$sut, __DIR__],
            'object' => [$sut, new stdClass()],
            'array' => [$sut, []],
            'invalid filename' => [$sut, 'not-a-file-at-all'],
            'integer' => [$sut, PHP_INT_MAX],
            'float' => [$sut, 1.222],
            'boolean true' => [$sut, true],
            'boolean false' => [$sut, false],
        ];
    }
}
