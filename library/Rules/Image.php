<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use finfo;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\Core\Simple;
use SplFileInfo;

use function is_file;
use function is_string;
use function mb_strpos;

use const FILEINFO_MIME_TYPE;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a valid image file',
    '{{subject}} must not be a valid image file',
)]
final class Image extends Simple
{
    public function __construct(
        private finfo $fileInfo = new finfo(FILEINFO_MIME_TYPE),
    ) {
    }

    public function isValid(mixed $input): bool
    {
        if ($input instanceof SplFileInfo) {
            return $this->isValid($input->getPathname());
        }

        if (!is_string($input)) {
            return false;
        }

        if (!is_file($input)) {
            return false;
        }

        return mb_strpos((string) $this->fileInfo->file($input), 'image/') === 0;
    }
}
