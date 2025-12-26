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
    '{{subject}} must be identical to {{compareTo}}',
    '{{subject}} must not be identical to {{compareTo}}',
)]
final readonly class Identical implements Rule
{
    public function __construct(
        private mixed $compareTo,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        return Result::of($input === $this->compareTo, $input, $this, ['compareTo' => $this->compareTo]);
    }
}
