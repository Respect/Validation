<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\StreamStub;
use SplFileInfo;
use SplFileObject;
use stdClass;

use function chmod;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Writable
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class WritableTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
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

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Writable();
        $filename = self::fixture('non-writable');

        chmod($filename, 0555);

        return [
            'unwritable PSR-7 stream' => [$rule, StreamStub::createUnwritable()],
            'unwritable filename' => [$rule, $filename],
            'unwritable SplFileInfo file' => [$rule, new SplFileInfo($filename)],
            'unwritable SplFileObject file' => [$rule, new SplFileObject($filename)],
            'invalid filename' => [$rule, '/path/of/a/valid/writable/file.txt'],
            'empty string' => [$rule, ''],
            'boolean true' => [$rule, true],
            'boolean false' => [$rule, false],
            'integer' => [$rule, 123456],
            'float' => [$rule, 1.1111],
            'instance of stdClass' => [$rule, new stdClass()],
            'array' => [$rule, []],
        ];
    }
}
