<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\Stubs\UploadedFileStub;
use Respect\Validation\Test\TestCase;
use SplFileInfo;

#[Group('validator')]
#[CoversClass(Uploaded::class)]
final class UploadedTest extends TestCase
{
    public const string UPLOADED_FILENAME = 'uploaded.ext';

    #[Test]
    public function itShouldValidateWhenFileIsUploadedAndTheInputIsString(): void
    {
        set_mock_is_uploaded_file_return(true);

        self::assertValidInput(new Uploaded(), self::UPLOADED_FILENAME);
    }

    #[Test]
    public function itShouldValidateWhenFileIsUploadedAndTheInputIsSplFileInfo(): void
    {
        set_mock_is_uploaded_file_return(true);

        self::assertValidInput(new Uploaded(), new SplFileInfo(self::UPLOADED_FILENAME));
    }

    #[Test]
    public function itShouldValidateWhenFileIsUploadedAndTheInputIsUploadedFile(): void
    {
        self::assertValidInput(new Uploaded(), UploadedFileStub::create());
    }

    #[Test]
    public function itShouldInvalidateWhenFileHasNotBeenUploaded(): void
    {
        set_mock_is_uploaded_file_return(false);

        self::assertInvalidInput(new Uploaded(), self::UPLOADED_FILENAME);
    }
}
