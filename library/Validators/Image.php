<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use finfo;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
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
final readonly class Image implements Validator
{
    public function evaluate(mixed $input): Result
    {
        if ($input instanceof SplFileInfo) {
            return $this->evaluate($input->getPathname());
        }

        if (!is_string($input) || !is_file($input)) {
            return Result::failed($input, $this);
        }

        return Result::of(
            mb_strpos((string) (new finfo(FILEINFO_MIME_TYPE))->file($input), 'image/') === 0,
            $input,
            $this,
        );
    }
}
