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
use function mb_strpos;

use const FILEINFO_MIME_TYPE;

/**
 * Validates if the file is a valid image by checking its MIME type.
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Image extends AbstractRule
{
    /**
     * @var finfo
     */
    private $fileInfo;

    /**
     * Initializes the rule.
     */
    public function __construct(?finfo $fileInfo = null)
    {
        $this->fileInfo = $fileInfo ?: new finfo(FILEINFO_MIME_TYPE);
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
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

        return mb_strpos((string) $this->fileInfo->file($input), 'image/') === 0;
    }
}
