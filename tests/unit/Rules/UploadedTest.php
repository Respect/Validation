<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\SkippedTestError;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\UploadedFileStub;
use SplFileInfo;
use stdClass;

use function extension_loaded;
use function uopz_set_return;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Uploaded
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class UploadedTest extends RuleTestCase
{
    public const UPLOADED_FILENAME = 'uploaded.ext';

    /**
     * {@inheritDoc}
     */
    public static function providerForValidInput(): array
    {
        $rule = new Uploaded();

        return [
            [$rule, self::UPLOADED_FILENAME],
            [$rule, new SplFileInfo(self::UPLOADED_FILENAME)],
            [$rule, UploadedFileStub::create()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public static function providerForInvalidInput(): array
    {
        $rule = new Uploaded();

        return [
            [$rule, 'not-uploaded.ext'],
            [$rule, new SplFileInfo('not-uploaded.ext')],
            [$rule, []],
            [$rule, 1],
            [$rule, new stdClass()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        if (!extension_loaded('uopz')) {
            throw new SkippedTestError('Extension "uopz" is required to test "Uploaded" rule');
        }

        uopz_set_return(
            'is_uploaded_file',
            static function (string $filename): bool {
                return $filename === UploadedTest::UPLOADED_FILENAME;
            },
            true
        );
    }
}
