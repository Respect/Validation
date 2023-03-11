<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Size
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class SizeTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $root = vfsStream::setup();
        $file2Kb = vfsStream::newFile('2kb.txt')
            ->withContent(LargeFileContent::withKilobytes(2))
            ->at($root);
        $file2Mb = vfsStream::newFile('2mb.txt')
            ->withContent(LargeFileContent::withMegabytes(2))
            ->at($root);

        /** @var MockObject $psr7Stream1Mb */
        $psr7Stream1Mb = $this->createMock(StreamInterface::class);
        $psr7Stream1Mb->expects(self::once())->method('getSize')->willReturn(1024);

        /** @var MockObject $psr7UploadedFileMb */
        $psr7UploadedFileMb = $this->createMock(UploadedFileInterface::class);
        $psr7UploadedFileMb->expects(self::once())->method('getSize')->willReturn(1024);

        return [
            'file with at least 1kb' => [new Size('1kb', null), $file2Kb->url()],
            'file with at least 2k' => [new Size('2kb', null), $file2Kb->url()],
            'file with up to 2kb' => [new Size(null, '2kb'), $file2Kb->url()],
            'file with up to 3kb' => [new Size(null, '3kb'), $file2Kb->url()],
            'file between 1kb and 3kb' => [new Size('1kb', '3kb'), $file2Kb->url()],
            'file with at least 1mb' => [new Size('1mb', null), $file2Mb->url()],
            'file with at least 2mb' => [new Size('2mb', null), $file2Mb->url()],
            'file with up to 2mb' => [new Size(null, '2mb'), $file2Mb->url()],
            'file with up to 3mb' => [new Size(null, '3mb'), $file2Mb->url()],
            'file between 1mb and 3mb' => [new Size('1mb', '3mb'), $file2Mb->url()],
            'SplFileInfo instance' => [new Size('1mb', '3mb'), new SplFileInfo($file2Mb->url())],
            'PSR-7 stream' => [new Size('1kb', '2kb'), $psr7Stream1Mb],
            'PSR-7 UploadedFile' => [new Size('1kb', '2kb'), $psr7UploadedFileMb],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $root = vfsStream::setup();
        $file2Kb = vfsStream::newFile('2kb.txt')
            ->withContent(LargeFileContent::withKilobytes(2))
            ->at($root);
        $file2Mb = vfsStream::newFile('2mb.txt')
            ->withContent(LargeFileContent::withMegabytes(2))
            ->at($root);

        /** @var MockObject $psr7Stream1Mb */
        $psr7Stream1Mb = $this->createMock(StreamInterface::class);
        $psr7Stream1Mb->expects(self::once())->method('getSize')->willReturn(1024);

        /** @var MockObject $psr7UploadedFileMb */
        $psr7UploadedFileMb = $this->createMock(UploadedFileInterface::class);
        $psr7UploadedFileMb->expects(self::once())->method('getSize')->willReturn(1024);

        return [
            'file with at least 3kb' => [new Size('3kb', null), $file2Kb->url()],
            'file with up to 1kb' => [new Size(null, '1kb'), $file2Kb->url()],
            'file between 1kb and 1.5kb' => [new Size('1kb', '1.5kb'), $file2Kb->url()],
            'file with at least 2.5mb' => [new Size('2.5mb', null), $file2Mb->url()],
            'file with at least 3gb' => [new Size('3gb', null), $file2Mb->url()],
            'file with up to 1b' => [new Size(null, '1b'), $file2Mb->url()],
            'file between 1pb and 3pb' => [new Size('1pb', '3pb'), $file2Mb->url()],
            'SplFileInfo instancia' => [new Size('1pb', '3pb'), new SplFileInfo($file2Mb->url())],
            'parameter invalid' => [new Size('1pb', '3pb'), []],
            'PSR-7 stream' => [new Size('1MB', '1.1MB'), $psr7Stream1Mb],
            'PSR-7 UploadedFile' => [new Size('1MB', '1.1MB'), $psr7UploadedFileMb],
        ];
    }

    /**
     * @test
     */
    public function shouldThrowsAnExceptionWhenSizeIsNotValid(): void
    {
        $this->expectException(ComponentException::class);
        $this->expectExceptionMessage('"42jb" is not a recognized file size');

        new Size('42jb');
    }
}
