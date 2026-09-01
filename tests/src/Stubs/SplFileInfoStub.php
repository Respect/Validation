<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use SplFileInfo;

final class SplFileInfoStub extends SplFileInfo
{
    private int|false $size = false;

    public static function createWithoutSize(string $filename): self
    {
        return new self($filename);
    }

    public static function createWithSize(string $filename, int $size): self
    {
        $stub = new self($filename);
        $stub->size = $size;

        return $stub;
    }

    public function getSize(): int|false
    {
        return $this->size;
    }
}
