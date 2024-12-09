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
    '{{name}} must be a valid image file',
    '{{name}} must not be a valid image file',
)]
final class Image extends Simple
{
    private readonly finfo $fileInfo;

    public function __construct(?finfo $fileInfo = null)
    {
        $this->fileInfo = $fileInfo ?: new finfo(FILEINFO_MIME_TYPE);
    }

    protected function isValid(mixed $input): bool
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
