<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Danilo Correa <danilosilva87@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Test\Stubs\StreamStub;
use Respect\Validation\Test\Stubs\UploadedFileStub;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Test\Validators\Stub;
use SplFileInfo;

use function uniqid;

#[Group('validator')]
#[CoversClass(Size::class)]
final class SizeTest extends TestCase
{
    private vfsStreamDirectory $root;

    #[Before]
    public function setUpVfsStream(): void
    {
        $this->root = vfsStream::setup();
    }

    #[Test]
    public function shouldThrowsAnExceptionWhenSizeIsNotValid(): void
    {
        $this->expectException(InvalidValidatorException::class);
        $this->expectExceptionMessage('"whatever" is not a recognized data storage unit');

        // @phpstan-ignore-next-line
        new Size('whatever', Stub::daze());
    }

    #[Test]
    public function shouldGetTheSizeOfFilePassedAsString(): void
    {
        $file = vfsStream::newFile(uniqid())
            ->withContent(LargeFileContent::withKilobytes(2))
            ->at($this->root);

        $wrapped = Stub::pass(1);
        $validator = new Size('KB', $wrapped);
        $validator->evaluate($file->url());

        self::assertSame([2], $wrapped->inputs);
    }

    #[Test]
    public function shouldGetTheSizeOfFilePassedAsSplFileInfo(): void
    {
        $file = vfsStream::newFile(uniqid())
            ->withContent(LargeFileContent::withGigabytes(1))
            ->at($this->root);

        $wrapped = Stub::pass(1);
        $validator = new Size('GB', $wrapped);
        $validator->evaluate(new SplFileInfo($file->url()));

        self::assertSame([1], $wrapped->inputs);
    }

    #[Test]
    public function shouldGetTheSizeOfFilePassedAsUploadedFileInterface(): void
    {
        $file = UploadedFileStub::createWithSize(1024);

        $wrapped = Stub::pass(1);
        $validator = new Size('KB', $wrapped);
        $validator->evaluate($file);

        self::assertSame([1], $wrapped->inputs);
    }

    #[Test]
    public function shouldGetTheSizeOfFilePassedAsStreamInterface(): void
    {
        $file = StreamStub::createWithSize(2 * 1024 ** 2);

        $wrapped = Stub::pass(1);
        $validator = new Size('MB', $wrapped);
        $validator->evaluate($file);

        self::assertSame([2], $wrapped->inputs);
    }
}
