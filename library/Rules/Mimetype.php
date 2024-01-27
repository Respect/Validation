<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use SplFileInfo;

use function is_file;
use function is_string;

use const FILEINFO_MIME_TYPE;

final class Mimetype extends AbstractRule
{
    private finfo $fileInfo;

    public function __construct(private string $mimetype, ?finfo $fileInfo = null)
    {
        $this->fileInfo = $fileInfo ?: new finfo();
    }

    public function validate(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->validate($input->getPathname());
        }

        if (!is_string($input)) {
            return false;
        }

        if (!is_file($input)) {
            return false;
        }

        return $this->mimetype === $this->fileInfo->file($input, FILEINFO_MIME_TYPE);
    }
}
