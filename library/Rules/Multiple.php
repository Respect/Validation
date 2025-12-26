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

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    '{{subject}} must be a multiple of {{multipleOf}}',
    '{{subject}} must not be a multiple of {{multipleOf}}',
)]
final readonly class Multiple implements Rule
{
    public function __construct(
        private int $multipleOf,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $parameters = ['multipleOf' => $this->multipleOf];
        if ($this->multipleOf == 0) {
            return Result::of($input == 0, $input, $this, $parameters);
        }

        return Result::of($input % $this->multipleOf == 0, $input, $this, $parameters);
    }
}
