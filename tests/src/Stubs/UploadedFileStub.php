<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

use const UPLOAD_ERR_OK;

final class UploadedFileStub implements UploadedFileInterface
{
    private int|null $size = null;

    public static function create(): self
    {
        return new self();
    }

    public static function createWithSize(int $size): self
    {
        $stub = new self();
        $stub->size = $size;

        return $stub;
    }

    public function getStream(): StreamInterface
    {
        return StreamStub::create();
    }

    public function moveTo(string $targetPath): void
    {
    }

    public function getSize(): int|null
    {
        return $this->size;
    }

    public function getError(): int
    {
        return UPLOAD_ERR_OK;
    }

    public function getClientFilename(): string|null
    {
        return null;
    }

    public function getClientMediaType(): string|null
    {
        return null;
    }
}
