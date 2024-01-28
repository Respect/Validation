<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\SkippedWithMessageException;
use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\UploadedFileStub;
use SplFileInfo;
use stdClass;

use function extension_loaded;
use function uopz_set_return;

#[Group('rule')]
#[CoversClass(Uploaded::class)]
final class UploadedTest extends RuleTestCase
{
    public const UPLOADED_FILENAME = 'uploaded.ext';

    /**
     * @return array<array{Uploaded, mixed}>
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
     * @return array<array{Uploaded, mixed}>
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

    protected function setUp(): void
    {
        if (!extension_loaded('uopz')) {
            throw new SkippedWithMessageException('Extension "uopz" is required to test "Uploaded" rule');
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
