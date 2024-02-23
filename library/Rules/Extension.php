<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use SplFileInfo;

use function is_string;
use function pathinfo;

use const PATHINFO_EXTENSION;

#[Template(
    '{{name}} must have {{extension}} extension',
    '{{name}} must not have {{extension}} extension',
)]
final class Extension extends Standard
{
    public function __construct(
        private readonly string $extension
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['extension' => $this->extension];
        if ($input instanceof SplFileInfo) {
            return (new Result($this->extension === $input->getExtension(), $input, $this))
                ->withParameters($parameters);
        }

        if (!is_string($input)) {
            return Result::failed($input, $this)->withParameters($parameters);
        }

        return (new Result($this->extension === pathinfo($input, PATHINFO_EXTENSION), $input, $this))
            ->withParameters($parameters);
    }
}
