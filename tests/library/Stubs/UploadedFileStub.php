<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

use const UPLOAD_ERR_OK;

final class UploadedFileStub implements UploadedFileInterface
{
    private ?int $size = null;

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

    /**
     * {@inheritDoc}
     */
    public function moveTo($targetPath): void
    {
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getError(): int
    {
        return UPLOAD_ERR_OK;
    }

    public function getClientFilename(): ?string
    {
        return null;
    }

    public function getClientMediaType(): ?string
    {
        return null;
    }
}
