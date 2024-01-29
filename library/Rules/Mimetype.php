<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use Respect\Validation\Attributes\Template;
use SplFileInfo;

use function is_file;
use function is_string;

use const FILEINFO_MIME_TYPE;

#[Template(
    '{{name}} must have {{mimetype}} MIME type',
    '{{name}} must not have {{mimetype}} MIME type',
)]
final class Mimetype extends AbstractRule
{
    public function __construct(
        private readonly string $mimetype,
        private readonly finfo $fileInfo = new finfo()
    ) {
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

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return ['mimetype' => $this->mimetype];
    }
}
