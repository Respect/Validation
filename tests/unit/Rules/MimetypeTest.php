<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use SplFileObject;

use function random_int;
use function tmpfile;

use const FILEINFO_MIME_TYPE;
use const PHP_INT_MAX;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\Mimetype
 */
final class MimetypeTest extends RuleTestCase
{
    /**
     * @test
     */
    public function itShouldValidateWithDefinedFinfoInstance(): void
    {
        $mimetype = 'application/octet-stream';
        $filename = 'tests/fixtures/valid-image.png';

        $fileInfoMock = $this
            ->getMockBuilder(finfo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fileInfoMock
            ->expects(self::once())
            ->method('file')
            ->with($filename, FILEINFO_MIME_TYPE)
            ->will(self::returnValue($mimetype));

        $rule = new Mimetype($mimetype, $fileInfoMock);

        self::assertTrue($rule->validate($filename));
    }

    /**
     * @return array<array{Mimetype, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            'image/png' => [new Mimetype('image/png'), 'tests/fixtures/valid-image.png'],
            'image/gif' => [new Mimetype('image/gif'), 'tests/fixtures/valid-image.gif'],
            'image/jpeg' => [new Mimetype('image/jpeg'), 'tests/fixtures/valid-image.jpg'],
            'text/plain' => [new Mimetype('text/plain'), 'tests/fixtures/executable'],
            'SplFileInfo' => [new Mimetype('image/png'), new SplFileInfo('tests/fixtures/valid-image.png')],
            'SplFileObject' => [new Mimetype('image/png'), new SplFileObject('tests/fixtures/valid-image.png')],
        ];
    }

    /**
     * @return array<array{Mimetype, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            'invalid file' => [new Mimetype('image/png'), 'tests/fixtures/invalid-image.png'],
            'mismatch' => [new Mimetype('image/gif'), 'tests/fixtures/valid-image.png'],
            'directory' => [new Mimetype('application/octet-stream'), __DIR__],
            'boolean' => [new Mimetype('application/octet-stream'), true],
            'array' => [new Mimetype('application/octet-stream'), [__FILE__]],
            'integer' => [new Mimetype('application/octet-stream'), random_int(1, PHP_INT_MAX)],
            'float' => [new Mimetype('application/octet-stream'), random_int(1, 9) / 10],
            'null' => [new Mimetype('application/octet-stream'), null],
            'resource' => [new Mimetype('application/octet-stream'), tmpfile()],
        ];
    }
}
