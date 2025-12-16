<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\Stubs\UploadedFileStub;
use Respect\Validation\Test\TestCase;
use SplFileInfo;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Uploaded
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class UploadedTest extends TestCase
{
    public const UPLOADED_FILENAME = 'uploaded.ext';

    /**
     * @test
     */
    public function itShouldValidateWhenFileIsUploadedAndTheInputIsString(): void
    {
        set_mock_is_uploaded_file_return(true);

        self::assertValidInput(new Uploaded(), self::UPLOADED_FILENAME);
    }

    /**
     * @test
     */
    public function itShouldValidateWhenFileIsUploadedAndTheInputIsSplFileInfo(): void
    {
        set_mock_is_uploaded_file_return(true);

        self::assertValidInput(new Uploaded(), new SplFileInfo(self::UPLOADED_FILENAME));
    }

    /**
     * @test
     */
    public function itShouldValidateWhenFileIsUploadedAndTheInputIsUploadedFile(): void
    {
        self::assertValidInput(new Uploaded(), UploadedFileStub::create());
    }

    /**
     * @test
     */
    public function itShouldInvalidateWhenFileHasNotBeenUploaded(): void
    {
        set_mock_is_uploaded_file_return(false);

        self::assertInvalidInput(new Uploaded(), self::UPLOADED_FILENAME);
    }
}
