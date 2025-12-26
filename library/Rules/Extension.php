<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use SplFileInfo;

use function is_string;
use function pathinfo;

use const PATHINFO_EXTENSION;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must have {{extension}} extension',
    '{{subject}} must not have {{extension}} extension',
)]
final readonly class Extension implements Rule
{
    public function __construct(
        private string $extension,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['extension' => $this->extension];
        if ($input instanceof SplFileInfo) {
            return Result::of($this->extension === $input->getExtension(), $input, $this, $parameters);
        }

        if (!is_string($input)) {
            return Result::failed($input, $this, $parameters);
        }

        return Result::of($this->extension === pathinfo($input, PATHINFO_EXTENSION), $input, $this, $parameters);
    }
}
