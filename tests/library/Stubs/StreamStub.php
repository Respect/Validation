<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Psr\Http\Message\StreamInterface;

use const SEEK_SET;

final class StreamStub implements StreamInterface
{
    private bool $isReadable = true;

    private bool $isWritable = true;

    private ?int $size = null;

    public static function create(): self
    {
        return new self();
    }

    public static function createUnwritable(): self
    {
        $stream = new self();
        $stream->isWritable = false;

        return $stream;
    }

    public static function createUnreadable(): self
    {
        $stream = new self();
        $stream->isReadable = false;

        return $stream;
    }

    public static function createWithSize(int $size): self
    {
        $stream = new self();
        $stream->size = $size;

        return $stream;
    }

    public function close(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function detach()
    {
        return null;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function tell(): int
    {
        return 0;
    }

    public function eof(): bool
    {
        return true;
    }

    public function isSeekable(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function seek($offset, $whence = SEEK_SET): void
    {
    }

    public function rewind(): void
    {
    }

    public function isWritable(): bool
    {
        return $this->isWritable;
    }

    /**
     * {@inheritDoc}
     */
    public function write($string): int
    {
        return 0;
    }

    public function isReadable(): bool
    {
        return $this->isReadable;
    }

    /**
     * {@inheritDoc}
     */
    public function read($length): string
    {
        return '';
    }

    public function getContents(): string
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function getMetadata($key = null): void
    {
    }

    public function __toString(): string
    {
        return '';
    }
}
