<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use finfo;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rules\Core\Standard;
use SplFileInfo;

use function is_file;
use function is_string;

use const FILEINFO_MIME_TYPE;

#[Template(
    '{{name}} must have {{mimetype}} MIME type',
    '{{name}} must not have {{mimetype}} MIME type',
)]
final class Mimetype extends Standard
{
    public function __construct(
        private readonly string $mimetype,
        private readonly finfo $fileInfo = new finfo()
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

        return new Result(
            $this->mimetype === $this->fileInfo->file($input, FILEINFO_MIME_TYPE),
            $input,
            $this,
            $parameters
        );
    }
}
