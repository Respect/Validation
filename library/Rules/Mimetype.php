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
use Respect\Validation\Result;
use Respect\Validation\Rule;
use SplFileInfo;

use function is_file;
use function is_string;

use const FILEINFO_MIME_TYPE;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must have the {{mimetype}} MIME type',
    '{{subject}} must not have the {{mimetype}} MIME type',
)]
final readonly class Mimetype implements Rule
{
    public function __construct(
        private string $mimetype,
        private finfo $fileInfo = new finfo(),
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        if ($input instanceof SplFileInfo) {
            return $this->evaluate($input->getPathname());
        }

        $parameters = ['mimetype' => $this->mimetype];
        if (!is_string($input)) {
            return Result::failed($input, $this, $parameters);
        }

        if (!is_file($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of(
            $this->mimetype === $this->fileInfo->file($input, FILEINFO_MIME_TYPE),
            $input,
            $this,
            $parameters,
        );
    }
}
